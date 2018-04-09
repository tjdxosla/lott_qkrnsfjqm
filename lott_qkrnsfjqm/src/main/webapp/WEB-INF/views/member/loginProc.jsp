<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>

<script>
	if("${sessionScope.email}"!=""){
		alert("${result.name} 님. 환영 합니다.");
		document.location.replace("/");
	}else{
		alert("${msg}");
		document.location.replace("/member/login");
	}
</script>