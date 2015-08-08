var Type = {"PVUV":"3"};

function req(sid, tid, pid, proid, levelid, refer) {
    var url = getReqUrl(sid, tid, pid, proid, levelid, refer);
    reqImage(url);
}

function reqImage(url) {
    var newImage = function(src, random, callback) {
        var img = new Image();
        src = random ? (src + '&random=' + Math.random()+''+(new Date)) : src;
        img.setAttribute('src', src);
    };
    newImage(url, true);
}

function getReqUrl(sid, tid, pid, proid, levelid, refer) {
    sid = $.trim(sid);
    tid = $.trim(tid);
    pid = $.trim(pid);
    proid = $.trim(proid);
    levelid = $.trim(levelid);
    refer = $.trim(refer);
    var url = 'http://t.jr.jd.com/clickApp?sid=' + sid
        + '&tid=' + tid
        + '&pid=' + pid
        + '&proid=' + proid
        + '&level=' + levelid
        + '&refer=' + refer
        + '&t=' + new Date().getTime();
    return url;
}

$(function () {
	// 未获取到pid 则不做处理
	var hidePid = $('#tapp_page_point').val();
	if ($.trim(hidePid) == '') {
		return;
	}
	var sid = hidePid.substring(0, 1);
	var pid = hidePid;
	var proid = $('#_projectId').val();
	// pv请求
	req(sid, Type.PVUV, pid, proid, '', '');
});

