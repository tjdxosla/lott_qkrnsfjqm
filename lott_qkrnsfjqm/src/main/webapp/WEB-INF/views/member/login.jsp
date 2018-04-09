<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ include file="../include/header.jsp" %>
<script type="text/javascript"	src="../resources/js/memberJoin.js"></script>
<!-- content -->
<form name="frm_login" onSubmit="return loginValidate(document.forms[0])">
  <div class="form-group">
    <label for="email">아이디</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="pass">비밀번호</label>
    <input type="password" class="form-control" id="pass" placeholder="Password" name="pass">
  </div>
  <button type="submit" class="btn btn-primary">로그인</button>
  <button type="button" class="btn btn-danger" onClick="javascript:document.location.replace('/')">돌아가기</button>
</form>
<!-- content -->

<%@ include file="../include/footer.jsp" %>