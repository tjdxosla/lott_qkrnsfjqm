<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ include file="../include/header.jsp" %>
<script src="../resources/js/board.js"></script>
<!-- content -->
<div class="container">
	<form name="fEdit" onSubmit="return editValidation();">
		<input type="hidden" name="id" value="${edit.id }">
		<table class="table">
			<tr>
				<td>작성자 : <input type="text" name="name" value="${edit.name }"></td>			
			</tr>
			<tr>
				<td>새로운 비밀번호 : <input type="password" name="pwd"></td>
			</tr>
			<tr>
				<td>비밀번호 확인: <input type="password" name="pwd1"></td>
			</tr>			
	 		<tr>			
				<td>제목 : <input type="text" name="title" value="${edit.title }"></td>
			</tr>		
			<tr>
				<td>
					<textarea class="form-control" rows="5" id="comment" name="comment">${edit.content }</textarea>
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" class="btn primary">확인</button>
					<a href="<%=path%>/freeBoard/view?id=${edit.id}"><button type="button" class="btn primary">뒤로가기</button></a>
					<a href="<%=path%>/freeBoard/list"><button type="button" class="btn primary">목록</button></a>	
				</td>			
			</tr>
		</table>
	</form>
</div>
<!-- content -->

<%@ include file="../include/footer.jsp" %>