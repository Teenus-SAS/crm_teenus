$(document).ready(function() {
    $('#btnLogout').click(function(e) {
        e.preventDefault()

        $.ajax({
            url: '/api/logout',
            success: function(data, textStatus, xhr) {
                location.href = '../../../'
            },
        })
    })
})