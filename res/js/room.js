$(document).ready(function() {
	for (var i in grade1)
		if ($('#r' + grade1[i]).length != 0)
			$('#r' + grade1[i]).addClass('grade1');
	for (var i in grade2)
		if ($('#r' + grade2[i]).length != 0)
			$('#r' + grade2[i]).addClass('grade2');
	for (var i in grade3)
		if ($('#r' + grade3[i]).length != 0)
			$('#r' + grade3[i]).addClass('grade3');
	for (var i in gradef)
		if ($('#r' + gradef[i]).length != 0)
			$('#r' + gradef[i]).addClass('gradef');
	for (var i in grade0)
		if ($('#r' + grade0[i]).length != 0)
			$('#r' + grade0[i]).addClass('grade0');

	var target;
	if (grade == '1')
		target = grade1;
	else if (grade == '2')
		target = grade2;
	else if (grade == '3')
		target = grade3;
	else if (grade == 'i'){
		target = grade1.concat(grade2, grade3, gradef);
	}
	else
		target = gradef;


	for (var i in target)
		if ($('#r' + target[i]).length != 0 && canreg){
			$('#r' + target[i] + ' .title').html('<a class="rbtn" href="#" data-toggle="modal" data-target="#myModal" onclick="selectRoom(' + target[i] + ', ' + sex + ')">' + target[i] + '</a>');
			//$('#r' + target[i] + ' .person').html('<br>'+ticket_str);
		}

	var ticket_str;
	$.ajax({
		url: '../room/api/room.view',
		data: {rp: rp},
		type: 'POST',
		statusCode: {
			200: function(data) {
				for (var i in target)
					if ($('#r' + target[i]).length != 0 && canreg){
						$('#r' + target[i] + ' .person').html('<br>'+data.ticket_str[target[i]]);
					}
			},
			400: function(data) {
				alert('Error code: 400');
			},
			404: function(data) {
				alert('Error code: 404');
			}
		}
	});
})

//onclick="apply(' + target[i] + ', ' + sex + ')">'
function selectRoom(room, sex){
	var title = dorm_name + ' ' + room + '호에 등록한 사람의 목록입니다.';
	var dorm_str = (sex == 1)? 'A' : 'B';
	
	$.ajax({
		url: '../room/api/room.select',
		data: {rno: dorm_str + room},
		type: 'POST',
		statusCode: {
			200: function(data) {
				$('#roomModalLabel').html(title);
				$('#roomModalContent').html(data.content);
				$("#submitButton").attr("onclick",'apply(' + room + ', ' + sex + ')');
			},
			400: function(data) {
				alert('Error code: 400');
			},
			404: function(data) {
				alert('Error code: 404');
			}
		}
	});
}

function apply(room, sex) {
	$.ajax({
		url: '../room/api/ticket.submit',
		data: {rno: room, sex: sex},
		type: 'POST',
		statusCode: {
			200: function(data) {
				console.log(typeof data)
for (var key in data) {
   if (data.hasOwnProperty(key)) {
      console.log(key,':' ,data[key]);
   }
}
data=data["responseText"]
console.log(data)
console.log(typeof data)
console.log(data=="not_permitted")
				if(data.indexOf('success')!=-1){
					alert('등록하였습니다!');
				} else if (data == -1){
					alert('등록에 실패하였습니다. 정보부에게 문의하세요.');
				} else if(data.indexOf('over')!=-1){
					alert('등록할 수 있는 티켓의 갯수를 초과하였습니다.');
				} else if(data.indexOf('not_permitted')!=-1){
					alert('등록되지 않은 사용자입니다. 정보부에게 문의하세요.');
				} else if(data.indexOf('wrong_room')!=-1){
					alert('올바르지 않은 방입니다.');
				} else if(data.indexOf('time_out')!=-1){
					alert('티켓 입력 시간이 아닙니다.');
				} else {
					alert('알려지지 않은 오류입니다.');
				}
				location.reload();
			},
			400: function(data) {
				alert('Error code: 400');
			},
			404: function(data) {
				alert('Error code: 404');
			}
		}
	});
}

function del() {
	var rno = $("input[type=radio]:checked").attr("id");
	if ($("input[type=radio]:checked").length == 0)
	{
		alert('삭제할 티켓을 선택해주세요.');
		return;
	}
	var answer = confirm(rno + ' 티켓을 삭제하시겠습니까?');
	if (answer) {
		$.ajax({
			url: '../room/api/ticket.delete',
			data: {rno: rno},
			type: 'POST',
			statusCode: {
				200: function(data) {
					if(data == 0){
						alert('삭제하였습니다!');
					} else if (data == -1){
						alert('등록에 실패하였습니다. 정보부에게 문의하세요.');
					} else if(data == -2){
						alert('찾는 티켓이 없습니다.');
					} else if(data == 'not_permitted'){
						alert('등록되지 않은 사용자입니다. 정보부에게 문의하세요.');
					} else if(data == 'time_out'){
						alert('티켓 수정 시간이 아닙니다.');
					} else {
						alert('알려지지 않은 오류입니다.');
					}
					location.reload();
				},
				400: function(data) {
					alert('Error code: 400');
				},
				404: function(data) {
					alert('Error code: 404');
				}
			}
		});
	}
}

function resetTickets() {
	var answer = confirm('티켓 전체를 초기화 하시겠습니까?');
	if (answer) {
		$.ajax({
			url: '../room/api/ticket.reset',
			data: {},
			type: 'POST',
			statusCode: {
				200: function(data) {
					if(data == 0){
						alert('초기화하였습니다!');
					} else if(data == 'not_permitted'){
						alert('등록되지 않은 사용자입니다. 정보부에게 문의하세요.');
					}  else if(data == 'time_out'){
						alert('티켓 수정 시간이 아닙니다.');
					} else {
						alert('알려지지 않은 오류입니다.');
					}
					location.reload();
				},
				400: function(data) {
					alert('Error code: 400');
				},
				404: function(data) {
					alert('Error code: 404');
				}
			}
		});
	}
}

function contentReset(){
	$('#roomModalContent').html('Loading.........');
}
