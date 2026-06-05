setInterval(() => {

    fetch('../api/realtime_stok.php')
    .then(res => res.json())
    .then(data => {

        data.forEach(item => {
            let stok = document.getElementById('stok-'+item.id);

            if(stok){
                stok.innerHTML = 'Stok : ' + item.stok;
            }
        });
    });

}, 2000);