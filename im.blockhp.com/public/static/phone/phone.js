layui.use('mobile', function(){
    var mobile = layui.mobile
        ,layim = mobile.layim
        ,layer = mobile.layer;

    layim.config({
        title: '欢迎您：' + m_uname + '<a style="color: white;float: right;" href="javascript:void(0)" layim-event="newFriend"><i style="font-size: 25px;" class="layui-icon">&#xe61f;</i></a>'

        //上传图片接口
        ,uploadImage: {
            url: '/phone/upload/uploadImg' //（返回的数据格式见下文）
            ,type: '' //默认post
        }

        //上传文件接口
        ,uploadFile: {
            url: '/phone/upload/uploadFile' //（返回的数据格式见下文）
            ,type: '' //默认post
        }

        ,init: userlist

        //扩展更多列表
        ,moreList: [{
            alias: 'find'
            ,title: '好友通知'
            ,iconUnicode: '&#xe667;' //图标字体的unicode，可不填
            ,iconClass: '' //图标字体的class类名
        }, {
                alias: 'groupNotice'
                ,title: '群组通知'
                ,iconUnicode: '&#xe645;' //图标字体的unicode，可不填
                ,iconClass: '' //图标字体的class类名
        },{
            alias: 'addGroup'
            ,title: '创建群组'
            ,iconUnicode: '&#xe608;' //图标字体的unicode，可不填
            ,iconClass: '' //图标字体的class类名
        },{
            alias: 'myGroup'
            ,title: '群组管理'
            ,iconUnicode: '&#xe770;' //图标字体的unicode，可不填
            ,iconClass: '' //图标字体的class类名
        },{
            alias: 'selfSetting'
            ,title: '个人设置'
            ,iconUnicode: '&#xe716;' //图标字体的unicode，可不填
            ,iconClass: '' //图标字体的class类名
        },{
            alias: 'about'
            ,title: '关于蜜聊'
            ,iconUnicode: '&#xe702;' //图标字体的unicode，可不填
            ,iconClass: '' //图标字体的class类名
        },{
            alias: 'logout'
            ,title: '退出登录'
            ,iconUnicode: '&#x1006;' //图标字体的unicode，可不填
            ,iconClass: '' //图标字体的class类名
        }]

        ,isNewFriend: true //是否开启“新的朋友”
        ,isgroup: true //是否开启“群聊”
        //,chatTitleColor: '#c00' //顶部Bar颜色
        //,title: 'LayIM' //应用名，默认：我的IM
        ,copyright: true
    });

    socket = new WebSocket(socket_server);
    // 连接发生错误的回调方法
    socket.onerror = function () {
        layer.msg('连接失败');
    };

    //连接成功时触发
    socket.onopen = function(){
        // 登录
        var login_data = '{"type":"init","id":"' + m_uid + '", "username":"' + m_uname + '", "avatar":"'
            + m_avatar + '", "sign":"' + m_sign + '"}';
        socket.send( login_data );
        console.log('连接成功');
        //layer.msg('连接成功');
    };

    //监听收到的消息
    socket.onmessage = function(res){
        //console.log(res.data);
        var data = eval("("+res.data+")");
        switch(data['message_type']){
            // 服务端ping客户端
            case 'ping':
                //console.log(data);
                socket.send('{"type":"ping"}');
                break;
            // 在线
            case 'online':
                layim.setFriendStatus(data.id, 'online');
                break;
            // 下线
            case 'offline':
                layim.setFriendStatus(data.id, 'offline');
                break;
            // 检测聊天数据
            case 'chatMessage':
                console.log(data.data);
                layim.getMessage(data.data);
                break;
            // 离线消息推送
            case 'logMessage':
                setTimeout(function(){layim.getMessage(data.data)}, 1000);
                break;
            // 用户退出 更新用户列表
            case 'logout':
                layim.setFriendStatus(data.id, 'offline');
                break;
            // 添加 分组信息
            case 'addGroup':
                //console.log(data.data);
                layim.addList(data.data);
                break;
            // 对方是否同意添加好友
            case 'addFriend':
                console.log(data.data);
                layim.addList(data.data);
                break;
            // 删除面板的群组
            case 'delGroup':
                //console.log(data.data);
                layim.removeList({
                    type: 'group'
                    ,id: data.data.id //群组ID
                });
                break;
        }
    };

    // 监听新的群组
    layim.on('newGroup', function(){

        var _html = [
            '<div class="layui-container" style="margin-top: 10px">',
            '<div class="layui-row">',
            '<div class="layui-col-xs9 layui-col-sm9 layui-col-md9">',
            '<input type="text" placeholder="请输入群名字" class="layui-input" id="search">',
            '</div>',
            '<div class="layui-col-xs2 layui-col-sm2 layui-col-md2"  style="margin-left: 10px">',
            '<button class="layui-btn" id="do-search">搜索</button>',
            '</div>',
            '</div>',
            '</div>',
            '<hr/>',
            '<blockquote class="layui-elem-quote">搜索结果</blockquote>',
            '<ul class="layui-layim-list layui-show" id="friends">',
            '</ul>'
        ].join('');

        layim.panel({
            title: '新的群组' //标题
            ,tpl: _html
        });

        // 搜索群组
        layui.use(['jquery', 'mobile'], function(){
            var $ = layui.jquery,
                mobile = layui.mobile,
                layer = mobile.layer;

            $("#do-search").click(function(){
                var search = $("#search").val();
                if('' == search){
                    layer.msg('群名不能为空');
                    return false;
                }

                $.post("/phone/finduser/search", {user_name: search}, function(res){
                    var _html = '';
                    if(1 == res.code){
                        $.each(res.data, function(k, v){

                            _html += '<li style="background: white;margin-top: 5px">';
                            _html += '<div><img src="' + v.avatar + '"></div>';
                            _html += '<span>' + v.group_name + '</span>';
                            _html += '<button class="layui-btn layui-btn-danger" style="float:right" data-uid="' +
                                v.id + '" data-name="' + v.group_name + '" data-avatar="' + v.avatar + '" onclick="addGroup(this)">添加</button></li>';
                        });

                        $('#friends').html(_html);
                    }else{
                        layer.msg(res.msg);
                    }

                }, 'json');
            });
        });
    });

    // 监听点击“新的朋友”
    layim.on('newFriend', function(){

        var _html = [
            '<div class="layui-container" style="margin-top: 10px">',
                '<div class="layui-row">',
                    '<div class="layui-col-xs9 layui-col-sm9 layui-col-md9">',
                        '<input type="text" placeholder="请输入用户名" class="layui-input" id="search">',
                    '</div>',
                    '<div class="layui-col-xs2 layui-col-sm2 layui-col-md2" style="margin-left: 10px">',
                        '<button class="layui-btn" id="do-search">搜索</button>',
                    '</div>',
                '</div>',
            '</div>',
            '<hr/>',
            '<blockquote class="layui-elem-quote">搜索结果</blockquote>',
            '<ul class="layui-layim-list layui-show" id="friends">',
            '</ul>'
        ].join('');

        layim.panel({
            title: '新的朋友' //标题
            ,tpl: _html
        });

        // 搜索好友
        layui.use(['jquery', 'mobile'], function(){
            var $ = layui.jquery,
                mobile = layui.mobile,
                layer = mobile.layer;
            $("#do-search").click(function(){
                var search = $("#search").val();
                if('' == search){
                    layer.msg('用户名不能为空');
                    return false;
                }

                $.post("/phone/finduser/index", {user_name: search}, function(res){
                    var _html = '';
                    if(-1 == res.code)
                    {
                        layer.msg('该好友不存在，请重新搜索');
                        return false;
                    }
                    if(1 == res.code){
                        $.each(res.data, function(k, v){

                            _html = '<li style="background: white;margin-top: 5px">';
                                _html += '<div><img src="' + v.avatar + '"></div>';
                            _html += '<span>' + v.user_name + '</span>';
                            _html += '<button class="layui-btn layui-btn-danger" style="float:right" data-uid="' +
                                v.id + '" onclick="addFriend(this)">添加</button></li>';
                        });
                    }
                    $('#friends').html(_html);
                }, 'json');
            });
        });
    });

    // 监听点击更多列表
    layim.on('moreList', function(obj){
        switch(obj.alias){
            // 好友验证消息
            case 'find':
                var _html = [
                    '<ul class="layui-layim-list layui-show" id="message">',
                    '</ul>'
                ].join('');

                layim.panel({
                    title: '好友通知' //标题
                    ,tpl: _html
                });

                showMessage();
                // 设置发现标记 为已读
                layim.showNew('More', false);
                layim.showNew('find', false);
                break;
            // 群组申请消息
            case 'groupNotice':
                var _html = [
                    '<ul class="layui-layim-list layui-show" id="message">',
                    '</ul>'
                ].join('');

                layim.panel({
                    title: '群组申请通知' //标题
                    ,tpl: _html
                });

                showGroupMessage();
                // 设置发现标记 为已读
                layim.showNew('More', false);
                layim.showNew('groupNotice', false);
                break;
            case 'addGroup':
                var _html = [
                    '<div class="layui-container" style="margin-top: 10px">',
                        '<div class="layui-row">',
                            '<div class="layui-col-xs9 layui-col-sm9 layui-col-md9">',
                                '<input type="text" placeholder="请输入群名" class="layui-input" id="search">',
                            '</div>',
                            '<div class="layui-col-xs2 layui-col-sm2 layui-col-md2" style="margin-left: 10px">',
                                '<button class="layui-btn" id="do-search">新建</button>',
                            '</div>',
                        '</div>',
                    '</div>'
                ].join('');

                layim.panel({
                    title: '新建群组' //标题
                    ,tpl: _html
                });

                // 搜索群组
                layui.use(['jquery', 'mobile'], function(){
                    var $ = layui.jquery,
                        mobile = layui.mobile,
                        layer = mobile.layer;

                    $("#do-search").click(function(){
                        var search = $("#search").val();
                        if('' == search){
                            layer.msg('群名不能为空');
                            return false;
                        }

                        $.post("/phone/msgbox/addGroup", {group_name: search}, function(res){
                            if(1 == res.code){
                                layer.msg(res.msg);

                                layim.addList({
                                    type: 'group'
                                    ,avatar: res.data.avatar
                                    ,groupname: res.data.group_name
                                    ,id: res.data.group_id
                                });
                                //新建群，定时刷新
                                setTimeout(function(){location.reload()},1500);
                            }else{
                                layer.msg(res.msg);
                            }

                        }, 'json');
                    });
                });
                break;
            // 群组管理
            case 'myGroup':
                var _html = [
                    '<ul class="layui-layim-list layui-show" id="groups">',
                    '</ul>'
                ].join('');

                layim.panel({
                    title: '群组管理' //标题
                    ,tpl: _html
                });

                showMyGroup();

                break;
            // 个人设置
            case 'selfSetting':
                var _html = [
                    '<div id="selfSetting">',
                    '</div>',
                ].join('');

                layim.panel({
                    title: '个人设置' //标题
                    ,tpl: _html
                });

                selfSetting();

                break;
            // 个人设置
            case 'about':
                var _html = [
                    '<div id="about">',
                    '</div>',
                ].join('');

                layim.panel({
                    title: '关于Mitalk' //标题
                    ,tpl: _html
                });

                about();

                break;
            // 退出
            case 'logout':
                layui.use(['jquery', 'layer'], function() {
                    var $ = layui.jquery;
                    //询问框
                    layer.open({
                        content: '您确定要退出登录吗？'
                        ,btn: ['是', '否']
                        ,yes: function(index){
                            //通知对方
                            $.post('/phone/login/logout', {
                                status: 1
                            }, function(res){
                                window.location.href = '/phone/login/index';
                            });
                            layer.close(index);
                        }
                    });
                });

                break;
        }
    });

    //监听发送消息
    layim.on('sendMessage', function(data){
        var mine = JSON.stringify(data.mine);
        var to = JSON.stringify(data.to);
        var login_data = '{"type":"chatMessage","data":{"mine":' + mine + ', "to":' + to + '}}';
        socket.send( login_data );
    });

    //监听查看更多记录
    layim.on('chatlog', function(data, ul){
        console.log(data);
        layim.panel({
            title: '与 '+ data.username +' 的聊天记录' //标题
            ,tpl: '<div style="padding: 10px;">这里是模版，{{d.data.test}}</div>' //模版
            ,data: { //数据
                test: 'Hello'
            }
        });
    });
});

// 加群组
function addGroup(obj){
    layui.use(['jquery', 'layer', 'mobile'], function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var mobile = layui.mobile
            ,layim = mobile.layim

        var uid = $(obj).attr('data-uid');
        var group_name = $(obj).attr('data-name');
        var group_avatar = $(obj).attr('data-avatar')

        $.post('/phone/msgbox/applyGroup', {group_id: uid, group_name: group_name, group_avatar: group_avatar}, function(res){
            if(1 != res.code){
                return layer.msg(res.msg);
            }
            layer.msg(res.msg);
        });
    });
}

// 加好友
function addFriend(obj){
    layui.use(['jquery', 'layer'], function(){
        var $ = layui.jquery;
		var layer = layui.layer;

        var uid = $(obj).attr('data-uid');
        //通知对方
        $.post('/phone/msgbox/applyFriend', {
            uid: uid
        }, function(res){
            if(res.code != 0){
                return layer.msg(res.msg);
            }
            layer.msg('好友申请已发送，请等待对方确认', {
                icon: 1
                ,shade: 0.5
            }, function(){
                layer.close(index);
            });
        });
    });
}

// 获取未读的消息 30s读取一次
setInterval(function(){
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile
            ,layim = mobile.layim
            ,$ = layui.jquery;
        $.getJSON('/phone/msgbox/getNoRead', function(res){
            if(res.data > 0){
                layim.showNew('More', true);
                layim.showNew('find', true);
            }
        });
    })
}, parseInt(30) * 1000);

// 获取群组通知 30s读取一次
setInterval(function(){
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile
            ,layim = mobile.layim
            ,$ = layui.jquery;
        $.getJSON('/phone/msgbox/getApplyNoRead', function(res){
            if(res.data > 0){
                layim.showNew('More', true);
                layim.showNew('groupNotice', true);
            }
        });
    })
}, parseInt(30) * 1000);

// 展示好友添加信息
function showMessage() {
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        $.getJSON('/phone/msgbox/getMsg', function(res){
            var _html = '';
            if(1 == res.code) {
                $.each(res.data, function (k, v) {

                    if (1 == v.type) {
                        if (0 == v.agree) {

                            _html += '<li style="background: white;margin-top: 5px"><div>';
                                _html += '<img src="' + v.user.avatar + '"></div><span>' + v.user.username + '</span>';
                            _html += '<button class="layui-btn layui-btn-xs" style="float:right;margin-left: 5px" data-id="' +
                                v.id + '" data-uid="' + v.user.id + '" data-sign="' + v.user.sign +
                                '" data-avatar="' + v.user.avatar + '" data-username="' + v.user.username + '" onclick="pass(this, 1)">同意</button>';
                            _html += '<button class="layui-btn layui-btn-danger layui-btn-xs" style="float:right" data-id="' +
                                v.id + '" data-uid="' + v.user.id + '" data-sign="' + v.user.sign +
                                '" data-avatar="' + v.user.avatar + '" data-username="' + v.user.username + '" onclick="pass(this, 2)">拒绝</button></li>';

                        } else if (1 == v.agree) {
                            _html += '<li style="background: white;margin-top: 5px"><div>';
                                _html += '<img src="' + v.user.avatar + '"></div><span>' + v.user.username + '</span>';
                            _html += '<span style="float:right;color:green">已同意</span>';
                        } else {
                            _html += '<li style="background: white;margin-top: 5px"><div>';
                                _html += '<img src="' + v.user.avatar + '"></div><span>' + v.user.username + '</span>';
                            _html += '<span style="float:right;color:red">已拒绝</span>';
                        }
                    } else {
                        _html += '<li style="background: white;margin-top: 5px">' + v.content + '</li>';
                    }

                });
            }
            $("#message").html(_html);
        });
    });
}

// 审批用户申请
function pass(obj, flag){
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        var id = $(obj).data('id');
        var uid = $(obj).data('uid');
        var sign = $(obj).data('sign');
        var avatar = $(obj).data('avatar');
        var username = $(obj).data('username');
        // 同意
        if(1 == flag){
            $.post('/phone/msgbox/agreeFriend', {
                uid: uid // 对方用户ID
                , from_group: 1 // 对方设定的好友分组
                , group: 1 // 我设定的好友分组
                , id : id
            }, function(res){
                if(res.code != 0){
                    return layer.msg(res.msg);
                }

                // 将好友追加到主面板
                layim.addList({
                    type: 'friend'
                    , avatar: avatar // 好友头像
                    , username: username // 好友昵称
                    , groupid: 1 // 所在的分组id
                    , id: uid // 好友ID
                    , sign: sign // 好友签名
                });

                // 通知对方将我加入好友列表
                var data = '{"type":"addFriend", "toid":"' + uid + '", "id":"' + m_uid + '", "username":"' +
                    m_uname + '", "avatar":"' + m_avatar + '", "sign":"' + m_sign + '", "groupid": 1}';
                socket.send(data);

                showMessage();
            });
        }else{

            // 不同意
            layer.open({
                content: '确定拒绝吗？'
                ,btn: ['确定', '不要']
                ,yes: function(index){
                    var id = $(obj).data('id');
                    var uid = $(obj).data('uid');

                    $.post('/phone/msgbox/refuseFriend', {
                        uid : uid, //对方用户ID
                        id : id
                    }, function(res){
                        if(res.code != 0){
                            return layer.msg(res.msg);
                        }
                        layer.close(index);
                        showMessage();
                    });
                }
            });
        }

    })
}


// 展示群组添加信息
function showGroupMessage() {
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        $.getJSON('/phone/msgbox/getGroupMsg', function(res){
            var _html = '';
            if(1 == res.code) {
                $.each(res.data, function (k, v) {

                    if (1 == v.is_system) {
                        if (1 == v.status) {
                            _html += '<li style="background: white;margin-top: 5px;padding: 0;font-size:14px">';
                            _html +=  '<p>'+ v.remark;
                            _html += '<button class="layui-btn" style="float:right;margin-left: 5px;padding: 0 5px;font-size: 14px" data-id="' + v.id + '" data-gid="' + v.join_group_id
                                + '" data-gname="' + v.join_group_name + '" data-gavatar="' + v.join_group_avatar + '" data-uid="' + v.from_id + '"  data-name="' + v.from_name + '" data-avatar="' + v.from_avatar
                                + '" data-sign="' + v.from_sign + '" onclick="passGroup(this, 1)">同意</button>';
                            _html += '<button class="layui-btn layui-btn-danger" style="float:right;padding: 0 5px;font-size: 14px" data-id="' + v.id + '"  data-gid="' + v.join_group_id
                                + '" data-gname="' + v.join_group_name + '" data-uid="' + v.from_id + '"  data-name="' + v.from_name + '" data-avatar="' + v.from_avatar
                                + '" data-sign="' + v.from_sign + '" onclick="passGroup(this, 2)">拒绝</button></p></li>';

                        } else if (2 == v.status) {
                            _html += '<li style="background: white;margin-top: 5px;">';
                            _html += '<p>' + v.remark;
                            _html += '<span style="float:right;color:green">已同意</span></p>';
                        } else {
                            _html += '<li style="background: white;margin-top: 5px;">';
                                _html += '<p>' + v.remark;
                            _html += '<span style="float:right;color:red">已拒绝</span></p>';
                        }
                    } else {
                        _html += '<li style="background: white;margin-top: 5px;"><p>' + v.remark + '</p></li>';
                    }

                });
            }
            $("#message").html(_html);
        });
    });
}

// 审批群组申请
function passGroup(obj, flag){
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        var gid = $(obj).data('gid');
        var uid = $(obj).data('uid');
        var sign = $(obj).data('sign');
        var avatar = $(obj).data('avatar');
        var username = $(obj).data('name');
        var gname = $(obj).data('gname');
        var id = $(obj).data('id');
        var gavatar = $(obj).data('gavatar');

        // 同意
        if(1 == flag){
            $.post('/phone/msgbox/joinGroup', {
                apply_id: uid
                , apply_name: username
                , apply_avatar : avatar
                , apply_sign: sign
                , group_id: gid
                , id: id
            }, function(res){
                if(res.code != 0){
                    return layer.msg(res.msg);
                }

                socket.send(JSON.stringify({
                    type: 'joinGroup',
                    join_id: uid,
                    group_id: gid,
                    group_avatar: gavatar,
                    group_name: gname
                }));

                showGroupMessage();
            });
        }else{

            // 不同意
            //询问框
            layer.open({
                content: '确定拒绝吗？'
                ,btn: ['确定', '不要']
                ,yes: function(index){
                    var id = $(obj).data('id');
                    var uid = $(obj).data('uid');

                    $.post('/phone/msgbox/refuseGroup', {
                        uid : uid, //对方用户ID
                        id : id
                    }, function(res){
                        if(res.code != 0){
                            return layer.msg(res.msg);
                        }
                        layer.close(index);
                        showGroupMessage();
                    });
                }
            });
        }

    })
}

// 展示我的群组
function showMyGroup() {

    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        $.getJSON('/phone/index/myGroup', function(res){
            var _html = '';
            if(1 == res.code) {

                $.each(res.data, function(k, v) {
                    _html += '<li style="background: white;margin-top: 5px">';
                    _html += '<div><img src="' + v.avatar + '"></div>';
                    _html += '<span>' + v.group_name + '</span>';
                    _html += '<button class="layui-btn layui-btn-primary" style="float:right;padding: 0 5px;font-size: 14px" onclick="showDetail(' + v.id + ')">群成员</button>';
                    _html += '</li>';
                });

                $("#groups").html(_html);
            }
        });
    });
}

//个人设置
function selfSetting() {

    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        $.getJSON('/phone/index/selfSetting', function(res){
            var _html = '';
            if(res) {
                _html += '<li style="background: white;margin-top: 5px"><form id="jvForm" method="post" enctype="multipart/form-data">';
                _html += '<div style="position: relative;"><input onclick="uploadingImg()" type="file" name="image" id="file" class="inputfile" accept="image/*"><img class="person-img" style="width: 30%;margin: 0 auto;padding-top: 10px;display: block;" src="' + res.avatar + '"></div>';
                _html += '<div style="width: 60%;margin: 20px auto 10px auto;" class="form-group"><input style="padding: 0 0 0 3px;" name="user_name" class="form-control" value="' + res.username + '" /></div>';
                _html += '<div style="width: 60%;margin: 10px auto 10px auto;" class="form-group"><label for="sex" style="padding-left: 0;" class="layui-form-label sex">性别:</label><div class="layui-input-block sex-left">';
                if(res.sex == 1)
                {
                    _html += '<input class="choose" name="sex" value="1" title="男" checked="checked" type="radio"><span class="chooseOne">男</span>';
                    _html += '<input class="choose" name="sex" value="-1" title="女" type="radio"><span class="chooseOne">女</span></div></div>';
                } else {
                    _html += '<input class="choose" name="sex" value="1" title="男" type="radio"><span class="chooseOne">男</span>';
                    _html += '<input class="choose" name="sex" value="-1" title="女" checked="checked" type="radio"><span class="chooseOne">女</span></div></div>';
                }
                _html += '<div style="width: 60%;margin: 10px auto 20px auto;" class="form-group"><input type="password" style="padding: 0 0 0 3px;" name="pwd" placeholder="登录密码修改(无需修改则不填)" class="form-control" value="" /></div>';
                _html += '<div style="width: 60%;margin: 20px auto 20px auto;" class="form-group"><input style="padding: 0 0 0 3px;" name="truename" class="form-control" placeholder="邮箱修改(无需修改则不填)" value="" /></div>';
                _html += '<div style="width: 60%;margin: 10px auto 10px auto;padding-bottom: 30px;text-align: center;" class="form-group"><button style="width: 60%;background-color: #ed5356;border-color: #ed5356;" type="button" class="btn btn-primary block full-width m-b" onclick="changeUserInfo()" >修 改</button></div>';
                _html += '</form></li>';

                $("#selfSetting").html(_html);
            }
        });
    });
}

//关于
function about() {

    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        $.getJSON('/phone/index/about', function(res){
            var _html = '';
            if(res) {
                _html += '<li style="background: white;margin-top: 5px">';
                _html += '<div style="position: relative;text-align: center;font-weight: 600;color: #666;padding-top: 30px;">关于Mitalk密聊</div>';
                _html += '<div style="width: 90%;margin: 20px auto 40px auto;color: #999;text-indent:20px" class="form-group">'+res.desc+'</div>';
                _html += '<div style="width: 80%;margin: 15px auto 15px auto;color: #999;" class="form-group"><span style="color: #666;">联系方式: </span> '+res.contact+'</div>';
                _html += '<div style="width: 80%;margin: 15px auto 15px auto;color: #999;" class="form-group"><span style="color: #666;">QQ: </span>'+res.qq+'</div>';
                _html += '<div style="width: 80%;margin: 15px auto 15px auto;color: #999;padding-bottom: 30px;" class="form-group"><span style="color: #666;">微信: </span>'+res.wx+'</div>';
                _html += '</li>';

                $("#about").html(_html);
            }
        });
    });
}

// 展示群成员
function showDetail(id) {

    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        var _html = [
            '<ul class="layui-layim-list layui-show" id="detail">',
            '</ul>'
        ].join('');

        layim.panel({
            title: '群成员' //标题
            ,tpl: _html
        });

        $.getJSON('/phone/index/groupDetail', {gid: id}, function(res){
            if(1 == res.code) {

                $.each(res.data, function(k, v) {
                    _html += '<li style="background: white;margin-top: 5px">';
                    _html += '<div><img src="' + v.user_avatar + '"></div>';
                    _html += '<span>' + v.user_name + '</span>';
                    if(v.user_id != res.msg) {
                        _html += '<button class="layui-btn layui-btn-danger" style="float:right;padding: 0 5px;font-size: 14px" data-gid="'
                            + v.group_id + '" data-uid="' + v.user_id + '" onclick="kick(this)">踢出</button>';
                    }

                    _html += '</li>';
                });

                $("#detail").html(_html);
            }
        });
    });
}

// 踢出群成员
function kick(obj) {

    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        var gid = $(obj).data('gid');
        var uid = $(obj).data('uid');

        $.post('/phone/index/removeMember', {gid: gid, uid: uid}, function (res) {

            if(1 == res.code) {
                $(obj).parent().remove();
                socket.send(JSON.stringify({
                    type: 'removeMember',
                    remove_id: uid,
                    group_id: gid
                }));
            }else {

                layer.msg(res.msg);
            }

        }, 'json');

    });

}

//上传图片
function uploadingImg() {
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        //ajax异步图片上传
        $('#file').change(function(){
            var file_obj = document.getElementById('file').files[0];
            var fd = new FormData();//创建一个表单对象fd，ajax传值就传这个对象
            fd.append('pic', file_obj);
            // 上传设置
            $.ajax({
                // 规定把请求发送到那个URL
                url: "/Phone/Index/uploadingImg",
                // 请求方式
                type: "post",
                dtaType: 'json',
                data:new FormData($('#jvForm')[0]),//传值就传fd对象了
                processData:false,  //告诉jQuery不要处理数据
                contentType: false,  //告诉jQuery不要设置contentType
                // 请求成功时执行的回调函数
                success: function (data) {
                    if(data.code == 200)
                    {
                        $('.person-img').attr('src',data.msg);
                        layer.open({
                            content: '头像设置成功！'
                            ,skin: 'msg'
                            ,time: 2 //2秒后自动关闭
                        });
                    }
                    if(data.code == 100)
                    {
                        layer.open({
                            content: data.msg
                            ,skin: 'msg'
                            ,time: 2 //2秒后自动关闭
                        });
                    }
                }
            });
        });

    });
}

//个人信息修改
function changeUserInfo() {
    layui.use(['mobile', 'jquery'], function(){
        var mobile = layui.mobile,
            layim = mobile.layim,
            layer = mobile.layer,
            $ = layui.jquery;

        if($("input[name='user_name']").val() == '')
        {
            layer.open({
                content: '请填写您的昵称！'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return false;
        }

        $.ajax({
            // 规定把请求发送到那个URL
            url: "/phone/index/changeUserInfo",
            // 请求方式
            type: "post",
            dtaType: 'json',
            data: {
                'sex': $("input[name='sex']:checked").val(),
                'user_name': $("input[name='user_name']").val(),
                'pwd': $("input[name='pwd']").val(),
                'truename': $("input[name='truename']").val(),
            },
            success: function (res) {
                layer.open({
                    content: res.msg
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
            }
        });
    });
}
