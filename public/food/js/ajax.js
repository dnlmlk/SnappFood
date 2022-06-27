$(document).ready(function (){

    let max = $('#max').val();
    for (let i=0; i<=max; i++) {
        $('#category'+i).click(function () {
            let categoryId = i;

            $.ajax({
                url: 'ManageFood/jQuery/ajax',
                type: "get",
                data: {category:categoryId},
                success: function(response){ // What to do if we succeed
                    console.log(response)
                    $('#foodBox').html(response);
                }
            });
        });
    }

})
