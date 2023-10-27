@extends('frontend.layout.app')
@section('title')
    Create
@endsection
@section('cont')
    <div class="custom-cont userpet-cont">
        <div>
            <h5>What kind of pets have you had?</h5>

            <div class="input-cont">
                <section class="input-label"><span>Kind of Petsss</span> <span><span id="data-change"><i class="fa fa-save"
                                style="color: blue" style="color: #8a8a8a;" id="save"></i><i class="fa fa-xmark"
                                style="color: #8a8a8a;"></i></span><i class="fa-solid fa-circle-info"
                            style="color: #8a8a8a;"></i></span></section>
                <div class="select-div" id="s-div">
                    {{-- <div class="badge-div">
                        <input type="checkbox">
                        <div>
                            <img src="/storage/uploads/cat.jpg" alt="-">
                        </div>
                        <span>
                            <b>Cat</b> <br>
                            <small>Pokhara</small>
                        </span>
                    </div> --}}
                </div>
                <input type="text" placeholder="Enter min 3 characters" id="uField">
                {{-- <form action="{{route('pet.upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <input type="file" name="filePath">
                        <button class="btn btn-primary">Submit</button>
                </form> --}}
                <div class="option-div">
                    <span>Total Option: <span id="total-opt">1</span></span>
                    <div class="select-opt">
                        <span><input type="checkbox" id="select" onclick="selection('select')"> Select All</span>
                        <span><input type="checkbox" onclick="selection('clear')" id="clear"> Clear</span>
                    </div>
                    <ul class="opt-list" id="opt-list">
                        {{-- <li>
                            <div class="badge-div">
                                <input type="checkbox">
                                <div>
                                    <img src="/storage/uploads/cat.jpg" alt="-">
                                </div>
                                <span>
                                    <b>Cat</b> <br>
                                    <small>Pokhara</small>
                                </span>
                            </div>
                        </li> --}}
                    </ul>
                </div>
                <span id="error">
                    No Result Found
                </span>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let srchData = [];
        $('#uField').on('keyup', () => {
            if ($('#uField').val().length >= 3) {
                $.ajax({
                    data: {
                        'search': $('#uField').val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    type: 'POST',
                    url: "{{ route('pet.search') }}",
                    success: function(res) {
                        $('.option-div').css({'display':'flex'});
                        $('#opt-list').html('');
                        let list = '';
                        $('#error').hide();
                        if (res.msg.length) {
                            $('#total-opt').html(res.msg.length);
                            srchData = res.msg;
                            res.msg.forEach(m => {
                                list += '<li><div class="badge-div">' +
                                    '<input type="checkbox" id="b-' + m.id +
                                    '" onclick=addBadge("' + m.id + '","' + m.name + '","' + m
                                    .location + '",flag=false,code="b-' + m.id + '")>' +
                                    '<div><img src="/storage/uploads/cat.jpg" alt="-"></div>' +
                                    '<span><b>' + m.name + '</b><br><small>' + m.location +
                                    '</small></span>' +
                                    '</div></li>';
                            });
                            $('#opt-list').html(list);

                        } else {
                            $('#error').show();
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

        });
        let saveList = [];
        let recents = [];
        let sList = '';

        function addBadge(id, name, location, flag, code) {
            $('#data-change').show();
            if (!$('#' + code).is(':checked')) {
                let index = saveList.indexOf(id);
                saveList.splice(index, 1);
                $('#s-' + id).prop('checked', false);
                $('#b-' + id).prop('checked', false);
            } else {
                saveList.push(id);
                let recentIndex = recents.indexOf(id);
                if (recentIndex == -1) {
                    recents.push(id);
                }
                $('#s-' + id).prop('checked', true);
                $('#b-' + id).prop('checked', true);
                console.log(recents);
                if (!flag) {
                    if (recentIndex == -1) {
                        sList += '<li><div class="badge-div">' +
                            '<input type="checkbox" checked id="s-' + id +
                            '" onclick=addBadge("' + id + '","' + name + '","' + location + '",flag=true,code="s-' + id +
                            '")>' +
                            '<div><img src="/storage/uploads/cat.jpg" alt="-"></div>' +
                            '<span><b>' + name + '</b><br><small>' + location +
                            '</small></span>' +
                            '</div></li>';
                        $('#s-div').html(sList);
                    }
                }
            }
        }

        $('#save').click(() => {
            // console.log(saveList);
            $.ajax({
                data: {
                    'list': saveList,
                    '_token': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: "{{ route('pet.upload') }}",
                success: function(res) {
                    console.log(res);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        function selection(cmd) {
            let sList = '';
            $('#data-change').show();

            srchData.forEach(s => {
                if (cmd === 'select') {
                    saveList.push(s.id);
                    let recentIndex = recents.indexOf(s.id);
                    if (recentIndex == -1) {
                        recents.push(s.id);
                    }
                    $('#b-' + s.id).prop('checked', true);
                    sList += '<li><div class="badge-div">' +
                        '<input type="checkbox" checked id="s-' + s.id +
                        '" onclick=addBadge("' + s.id + '","' + s.name + '","' + s.location +
                        '",flag=true,code="s-' + s.id + '")>' +
                        '<div><img src="/storage/uploads/cat.jpg" alt="-"></div>' +
                        '<span><b>' + s.name + '</b><br><small>' + s.location +
                        '</small></span>' +
                        '</div></li>';
                    $('#s-div').html(sList);
                }
                if (cmd === 'clear') {
                    $('#s-' + s.id).prop('checked', false);
                    let index = saveList.indexOf(s.id);
                    saveList.splice(index, 1);
                    $('.option-div').hide();
                    $('#clear').prop('checked',false);
                    $('#select').prop('checked',false);
                    $('#data-change').hide();
                    $('#uField').val('');
                }

            });
        }
    </script>
@endsection
