$(document).ready(function() {
    $('#bitform').validate({
        rules: {
            'sender[Wallet]': {
                required: true
            },
            'sender[Password]': {
                required: true
            },
            'amount': {
                required: true,
                number: true
            },
            'sender[Name]': {
                required: true
            },
            'receive[Wallet]': {
                required: true
            },
            'receive[Name]': {
                required: true
            },
            'sender[Postal]': {
                number: true
            },
            'receive[Postal]': {
                number: true
            }
        }
    });
});
$(function(){
    $('.add_wallet').click(function(e) {
        e.preventDefault();

        var row = $('.wallet_row');
        var row_clone;
        if(row.length > 1){
            row_clone = row.last().clone();
            row_clone.find('input[type="text"]').val('');
            row_clone.find('.wallet_id').val(0);
            row.last().after(row_clone);
        }
        else{
            row_clone = row.clone();
            row_clone.find('input[type="text"]').val('');
            row.after(row_clone);
        }
    });

    $('.table').on('click', '.delete_wallet',function(e){
        e.preventDefault();

        var row = $(this).parents('.wallet_row');
        var id = row.find('.wallet_id').val();
        if(id == 0) {
            if(row.prev().hasClass('wallet_row'))
                row.remove();
            else
                row.find('input[type="text"]').val('');
        } else {
            $.post('user_dashboard',
                {wallet_id: id, deleteWallet: 1}, function(data) {
                    if(data == 'ok'){
                        if(row.length > 1)
                            row.remove();
                        else{
                            row.find('input[type="text"]').val('');
                            row.find('.wallet_id').val(0);
                            location.reload();
                        }
                    }
                    else
                        alert(data);
                }
            );
        }
    })
});
