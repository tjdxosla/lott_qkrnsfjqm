/**
 * 
 */
function validation(){
	var frm = document.fBoard;
	
	if(frm.name.value=="" || frm.name.value==null){
		alert("제대로 작성 하시기 바랍니다.1");
		frm.name.focus();
		return false;
	}
	
	if(frm.pwd.value=="" || frm.pwd.value==null){
		alert("제대로 작성 하시기 바랍니다.2");
		frm.pwd.focus();
		return false;
	}
	
	if(frm.title.value=="" || frm.title.value==null){
		alert("제대로 작성 하시기 바랍니다.3");
		frm.title.focus();
		return false;
	}
	
	if(frm.comment.value=="" || frm.comment.value==null){
		alert("제대로 작성 하시기 바랍니다.4");
		frm.comment.focus();
		return false;
	}

	frm.method="POST";
	frm.action="/qkrnsfjqm/freeBoard/insertWrite";
	frm.submit();	
}

function editValidation(){
	var frm = document.fEdit;
	
	if(frm.name.value=="" || frm.name.value==null){
		alert("제대로 작성 하시기 바랍니다.1");
		frm.name.focus();
		return false;
	}
	
	if(frm.pwd.value=="" || frm.pwd.value==null){
		alert("제대로 작성 하시기 바랍니다.2");
		frm.pwd.focus();
		return false;
	}
	
	if(frm.title.value=="" || frm.title.value==null){
		alert("제대로 작성 하시기 바랍니다.3");
		frm.title.focus();
		return false;
	}
	
	if(frm.comment.value=="" || frm.comment.value==null){
		alert("제대로 작성 하시기 바랍니다.4");
		frm.comment.focus();
		return false;
	}

	frm.method="POST";
	frm.action="/qkrnsfjqm/freeBoard/updateEdit";
	frm.submit();	
}

function deleteView(id) {
	
	if(confirm("삭제하시겠습니까?")==true){
		document.location.href="/qkrnsfjqm/freeBoard/delete?id="+id;
	}
	
	
}