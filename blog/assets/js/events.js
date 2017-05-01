'use strict';


function onClickDelete(){

    event.preventDefault();
    var id;
    id = $(this).data('id');
    var parent = $(this).parents('tr');
    $.get('inc/deleteall.php',{'id' : id}, function () {
           parent.remove();
        });
}


function onClickAddComment(event) {
    event.preventDefault();
    var comment = $('#comment').val();
    var id;
    id = $(this).data('id');

console.log(comment);
console.log(id);

    $.post('index.php?page=entry&id='+id,{'comment' : comment}, function (htmlRetour) {
        $('#comments').html(htmlRetour);
    });
}


