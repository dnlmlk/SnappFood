$(document).ready(function (){

    $('#search').keyup(function (){
        let search = $('#search').val();

        $.ajax({
            url: 'ManageFood/jQuery/ajaxSearch',
            type: "get",
            data: {search:search},
            success: function(response){ // What to do if we succeed
                console.log(response)
                $('#foodBox').html(response);
            }
        });
    })




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
