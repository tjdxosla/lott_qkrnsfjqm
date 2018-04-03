<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ include file="../include/header.jsp" %>
<script src="../resources/js/board.js"></script>
<div class="container">
   <form name="fBoard" onSubmit="return validation();">
   <input type="hidden" name="check" value="n" />
      <div class="form-group">
         <label for="name">이름:</label>
         <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
         <label for="pwd">비밀번호:</label>
         <input type="password" class="form-control" id="pwd" name="pwd">
      </div>
      <div class="form-group">
         <label for="title">제목:</label>
         <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
         <label for="comment">Comment:</label>
         <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-default" >확인</button>
      <button type="reset" class="btn btn-default">다시쓰기</button>
   </form>
</div>

<%@ include file="../include/footer.jsp" %>