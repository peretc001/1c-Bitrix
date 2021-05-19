BX.ready(function() {
    let addressItems = document.querySelectorAll('.account-data__address-item');
    if(addressItems){
        addressItems.forEach(item => {
            item.querySelector('.account-data__address-item-favorite').addEventListener('click',function (e) {
                if ( document.querySelector('.account-data__address-item.active') )
                    document.querySelector('.account-data__address-item.active').classList.remove('active');
                let id = e.target.closest('.account-data__address-item').dataset.id;

                $.ajax({
                    url: "/ajax/addDeliveryfavorite.php",
                    type: 'post',
                    data: {ID: id},
                    success: function (response) {
                        e.target.closest('.account-data__address-item').classList.add('active');
                    }
                })
            })
            item.querySelector('.account-data__address-item-delete').addEventListener('click',function (e) {
                let id = e.target.closest('.account-data__address-item').dataset.id;
                $.ajax({
                    url: "/ajax/deleteDelivery.php",
                    type: 'post',
                    data: {ID: id},
                    success: function (response) {
                        e.target.closest('.account-data__address-item').remove()
                    }
                })
            })
        })
    }
});