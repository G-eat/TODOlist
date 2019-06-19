$(document).ready(function(){
  // updatetodo
  $(document).on("click", "#example", function () {
     let id = $(this).data('id');

     $.ajax({
            url: "../backend/updatetodo.php",
            method:'POST',
            data:{id:id},
            dataType:'JSON',
            success: function(result){
                $("#todoName").val(result.name);
                $("#todoDescriptions").val(result.descriptions);
                $("#todoDeadline").val(result.deadline);
                $("#todoPriority select").val(result.priority);
                $('#hiddenTodo').val(result.id);
     }});
  });

  // details/info todo
  $(document).on("click", "#descriptions", function () {
     let id = $(this).data('id');

     $.ajax({
            url: "../backend/updatetodo.php",
            method:'POST',
            data:{id:id},
            dataType:'JSON',
            success: function(result){
                $("#detailName").text(result.name);
                $("#detailDescription").text(result.descriptions);
                $("#detailDeadline").text(result.deadline);
                $("#detailPriority").text(result.priority);
                $('#detailId').val(result.id);
     }});
  });

  // check todos
  $('.done').click(function() {
    let id = $(this).data('id');

    let checked = '';
    if($(this). prop("checked") == true){
      checked = 1;
    }else if ($(this). prop("checked") == false) {
      checked = 0;
    }

    $.ajax({
             url: "../backend/checktodo.php",
             method:'POST',
             data:{id:id,checked:checked},
             dataType:'JSON',
             success: function(result){
      }});
  });


  // drag and drop
  $('#sortable').sortable({
    update: function (event,ui) {
      let positions = $("#sortable").sortable("toArray")
      // console.log(positions);


      $.ajax({
               url: "../backend/position.php",
               method:'POST',
               data:{positions:positions},
               dataType:'JSON',
               success: function(result){
        }});
    }
  });


});
