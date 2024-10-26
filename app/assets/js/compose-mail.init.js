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
  let content = editor.getData();
 
  if (op == 1) {
    // Limpieza del HTML para conservar saltos de línea en <br> y remover &nbsp;
    content = content
      .replace(/<p>&nbsp;<\/p>/g, '')           // Eliminar párrafos vacíos
      .replace(/<p>/g, '')                      // Remover etiquetas de apertura <p>
      .replace(/<\/p>/g, '<br>')                // Reemplazar etiquetas de cierre </p> por <br> para salto de línea
      .replace(/&nbsp;/g, ' ')                  // Reemplazar espacios en blanco (&nbsp;) por espacios normales
      .trim();
  }

  // Remueve posibles espacios extra al inicio y al final
  return content.trim();
};

/* Estabecer contenido */
setContent = (data) => {
  editor.setData(data);
};
