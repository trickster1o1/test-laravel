@extends('frontend.layout.app')
@section('title')
    Create
@endsection
@section('cont')
    <div class="custom-cont userpet-cont">
        <div>
            <h5>What kind of pets have you had?</h5>

            <div class="input-cont">
                <section class="input-label"><span>Kind of Petsss</span>
                    <span>
                        <span id="data-change">
                            <i class="fa fa-save" style="color: blue" style="color: #8a8a8a;" id="save" title="Save"></i>
                            <i class="fa fa-xmark" style="color: #8a8a8a;" onclick="cancel()" title="Cancel"></i>
                        </span>
                        <span id="saved-data" @if (count($pets)) class="disp-menu" @endif>
                            <i class="fa fa-trash text-danger" onclick="showDel()" title="Delete All"></i>
                            <i class="fa fa-edit" style="color: blue;" onclick="showIn()" title="Edit"></i>
                        </span>
                        <i class="fa-solid fa-circle-info" style="color: #8a8a8a;" title="Information"></i>

                    </span>
                </section>
                <span class="delete">Are you sure you want to delete? <i class="fa fa-check" onclick="deleteAll()"
                        style="display: inline-block;margin-right:1em; margin-left:.5em;"></i> <i class="fa fa-xmark"
                        onclick="hideMsg('delete')"></i></span> <br>
                <span class="success text-success">Pets assigned successfully. <i class="fa fa-xmark"
                        onclick="hideMsg('success')"></i></span>
                <div id="s-div"
                    @if (count($pets)) class="select-div saved" style="display: flex;" @else class="select-div" @endif)>
                    @if (count($pets))
                        @foreach ($pets as $pet)
                            <div class="badge-div">
                                <input type="checkbox" checked id='s-{{ $pet->id }}'
                                    onclick=addBadge('{{ $pet->id }}','{{ $pet->name }}','{{ $pet->location }}',flag=true,code='s-{{ $pet->id }}')>
                                <div>
                                    <img src="/storage/uploads/cat.jpg" alt="-">
                                </div>
                                <span>
                                    <b>{{ $pet->name }}</b> <br>
                                    <small>{{ $pet->location }}</small>
                                </span>
                            </div>
                        @endforeach
                    @endif
                </div>
                <input type="text" placeholder="Enter min 3 characters" id="uField"
                    @if (count($pets)) style="display: none;" @endif>
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
        // backend data ================================
        var record = {!! json_encode($pets->toArray()) !!};
        let srchData = [];

        let rmv = [];
        let saveList = [];
        let recents = [];
        record.forEach(r => {
            saveList.push(''+r['pet_id']);
            recents.push(''+r['pet_id']);
        });

        // Search Function ============================ 
        $('#uField').on('keyup', () => {
            if ($('#uField').val().length >= 3) {
                    $('#select').prop('checked', false);
                $.ajax({
                    data: {
                        'search': $('#uField').val(),
                        '_token': '{{ csrf_token() }}',
                    },
                    type: 'POST',
                    url: "{{ route('pet.search') }}",
                    success: function(res) {
                        $('.option-div').css({
                            'display': 'flex'
                        });
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
                                    .location + '",flag=false,code="b-' + m.id + '") ' + (!
                                        saveList.includes('' + m.id) ? "" : "checked") + ' >' +
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

        // Add function ========================================
        let sList = $('#s-div').html();

        function addBadge(id, name, location, flag, code) {
            console.log(recents);
            $('.select-div').removeClass('saved');

            if (!$('#' + code).is(':checked')) {
                rmv.push(code);

            } else {
                if (rmv.indexOf(code) != -1) {
                    rmv.splice(rmv.indexOf(id), 1);
                }
            }

            $('#s-div').css({
                'display': 'grid'
            });
            $('#data-change').show();
            if (!$('#' + code).is(':checked')) {
                let index = saveList.indexOf(''+id);
                saveList.splice(index, 1);
                $('#s-' + id).prop('checked', false);
                $('#b-' + id).prop('checked', false);
            } else {
                saveList.push(''+id);
                let recentIndex = recents.indexOf(''+id);
                if (recentIndex == -1) {
                    recents.push(''+id);
                }
                $('#s-' + id).prop('checked', true);
                $('#b-' + id).prop('checked', true);
                if (!flag) {
                    if (recentIndex == -1) {
                        sList += '<div class="badge-div">' +
                            '<input type="checkbox" checked id="s-' + id +
                            '" onclick=addBadge("' + id + '","' + name + '","' + location + '",flag=true,code="s-' + id +
                            '")>' +
                            '<div><img src="/storage/uploads/cat.jpg" alt="-"></div>' +
                            '<span><b>' + name + '</b><br><small>' + location +
                            '</small></span>' +
                            '</div>';
                        $('#s-div').html(sList);
                    }
                }
            }
        }

        // Save Function =====================================================
        function saveCmd(cmd) {
            $.ajax({
                data: {
                    'list': saveList,
                    '_token': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: "{{ route('pet.upload') }}",
                success: function(res) {
                    if (rmv.length) {
                        rmv.forEach(r => {
                            console.log(r);
                            $('#' + r).parent().hide();
                        });
                    }

                    $('.select-div').addClass('saved');

                    $('#uField').val('');
                    $('.option-div').hide();
                    $('.saved input').hide();
                    $('#select').prop('checked', false);
                    if (cmd == 'add') {
                        $('#uField').hide();
                        $('.success').show();
                        $('#data-change').hide();
                        $('#saved-data').show();
                    }

                },
                error: function(e) {
                    console.log(e);
                }
            });
        }

        $('#save').click(() => {
            saveCmd('add');
        });

        // Select All Logic =====================================

        function selection(cmd) {
            let sList = $('#s-div').html();
            $('.select-div').removeClass('saved');
            $('.select-div').css({'display':'grid'});
            $('#data-change').show();

            srchData.forEach(s => {
                if (cmd === 'select') {
                    
                    let recentIndex = recents.indexOf(''+s.id);
                    
                    if (!saveList.includes(s.id) && !saveList.includes(''+s.id)) {
                        saveList.push(''+s.id);

                        console.log('xirryo');
                        console.log(s.id);
                        $('#b-' + s.id).prop('checked', true);                
                        $('#s-' + s.id).prop('checked', true);
                        if (recentIndex == -1) {
                            sList += '<div class="badge-div">' +
                                '<input type="checkbox" checked id="s-' + s.id +
                                '" onclick=addBadge("' + s.id + '","' + s.name + '","' + s.location +
                                '",flag=true,code="s-' + s.id + '")>' +
                                '<div><img src="/storage/uploads/cat.jpg" alt="-"></div>' +
                                '<span><b>' + s.name + '</b><br><small>' + s.location +
                                '</small></span>' +
                                '</div>';
                            $('#s-div').html(sList);
                        }
                        //  else {

                        // }
                    }
                    if (recentIndex == -1) {
                        recents.push(''+s.id);
                    }

                }
                if (cmd === 'clear') {
                    $('#s-' + s.id).prop('checked', false);
                    let index = saveList.indexOf(''+s.id);
                    // let rindex = recents.indexOf(s.id);
                    // recents.splice(index, 1);
                    saveList.splice(index, 1);
                    $('.option-div').hide();
                    $('#clear').prop('checked', false);
                    $('#select').prop('checked', false);
                    $('#data-change').hide();
                    $('#uField').val('');
                    // $('#s-div').html('');
            // $('.select-div').hide();

                }
                console.log(saveList);

            });
        }

        // small button functions ======================
        function cancel() {
            window.location.reload();
        }

        function showIn() {
            $('#uField').show();
            $('.saved input').show();

        }

        function hideMsg(code) {
            $('.' + code).hide();
        }

        function deleteAll() {
            saveList = [];
            recents = [];
            saveCmd('delete');
            $('#uField').show();
            $('#s-div').hide();
            $('.delete').hide();
            $('#saved-data').hide();

        }

        function showDel() {
            $('.delete').show();
        }
    </script>
@endsection
