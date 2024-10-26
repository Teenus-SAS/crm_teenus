let editor;

// function composeMail() {
//   $('#compose-editor').length &&
//     ClassicEditor.create(document.querySelector('#compose-editor'))
//       .then(function (o) {
//         editor = o;
//       })
//       .catch(function (o) {
//         console.error('error', o);
//       });
// }
class Base64UploadAdapter {
  constructor(loader) {
    this.loader = loader;
  }
  upload() {
    return this.loader.file
      .then(file => {
        return new Promise((resolve, reject) => {
          const reader = new FileReader();
          reader.onload = () => resolve({ default: reader.result });
          reader.onerror = error => reject(error);
          reader.readAsDataURL(file);
        });
      });
  }
}

function composeMail() {
  if ($('#compose-editor').length) {
    ClassicEditor
      .create(document.querySelector('#compose-editor'), {
        extraPlugins: [MyCustomUploadAdapterPlugin],
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'imageUpload', 'undo', 'redo']
      })
      .then(editorInstance => {
        editor = editorInstance;
      })
      .catch(error => console.error(error));
  }
}

function MyCustomUploadAdapterPlugin(editor) {
  editor.plugins.get('FileRepository').createUploadAdapter = loader => {
    return new Base64UploadAdapter(loader);
  };
}

$(function () {
  composeMail();
});

/* Obtener contenido */
getContent = (op) => {
  content = editor.getData();

  // Limpia etiquetas innecesarias y conserva saltos de línea
  if (op == 1) {
    content = content
      .replace(/<p>/g, '') // Remueve todas las etiquetas de apertura <p>
      .replace(/<\/p>/g, '\n') // Reemplaza etiquetas de cierre </p> con salto de línea
      .replace(/<br\s*\/?>/g, '\n'); // Reemplaza <br> con salto de línea
  }

  // Remueve posibles espacios extra al inicio y al final
  return content.trim();
};

/* Estabecer contenido */
setContent = (data) => {
  editor.setData(data);
};
