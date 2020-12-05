<style>
    #c-nomor {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    #nomor {
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        width: 10rem;
        height: 10rem;
        background-color: blue;
        border-radius: 50%;
    }

    #nomor h1 {
        font-size: 4rem;
    }
</style>
<section id="user-list"></section>
<section id="c-nomor">
    <div id="nomor">

    </div>
    <br>
    <input type="number" name="antrian" id="antrian" hidden>
    <button class="btn btn-primary shadow" id="ambil">Ambil Nomor Antrian</button>
    <button class="btn btn-danger shadow" id="reset">Reset Nomor Antrian</button>
</section>


<script>
    $(function() {
        var conn = new WebSocket('ws://localhost:8080?access_token=<?= session()->get('id') ?>');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);

            var data = JSON.parse(e.data)

            if ('users' in data) {
                updateUsers(data.users)
            } else if ('message' in data) {
                newMessage(data)
            }

        };

        $('#ambil').on('click', function() {
            var msg = $('#antrian').val();
            if (msg == '') {
                msg = 1;
                console.log('true');
            } else {
                msg++;
                console.log('false');
            }
            console.log(msg);
            conn.send(msg)
            myMessage(msg);
            $('#antrian').val(msg);
        })

        $('#reset').on('click', function() {
            var msg = '';
            console.log(msg);
            conn.send(msg)
            myMessage(msg);
            $('#antrian').val(msg);
        })
    })

    function newMessage(msg) {
        console.log('test22');
        console.log(msg);
        html = `<h1>` + msg.message + `</h1>`
        $('#nomor').html(html);
        $('#antrian').val(msg.message);
    }

    function myMessage(msg) {
        html = `<h1>` + msg + `</h1>`
        $('#nomor').html(html);
    }

    function updateUsers(users) {
        var html = ''
        var myId = <?= session()->get('id') ?>;


        for (let index = 0; index < users.length; index++) {
            if (myId != users[index].c_user_id)
                html += '<li class="list-group-item">' + users[index].c_name + '</li>'
        }

        if (html == '') {
            html = '<p>The Chat Room is Empty</p>'
        }


        $('#user-list').html(html)


    }
</script>