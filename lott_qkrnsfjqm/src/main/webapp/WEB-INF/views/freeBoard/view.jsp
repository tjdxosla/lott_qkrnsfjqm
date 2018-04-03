<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ include file="../include/header.jsp" %>
<script src="../resources/js/board.js"></script>
<!-- content -->
<div class="container">
	<table class="table">
		<tr>
			<td>작성자 : ${view.name }</td>			
		</tr>
		<tr>
			<td>작성일 : ${view.day }</td>
		</tr>
		<tr>
			<td>조회수 : ${view.hit }</td>
		</tr>		
		<tr>			
			<td class="text-center">제목 : ${view.title }</td>
		</tr>		
		<tr>
			<td>
				<textarea class="form-control" rows="5" id="comment" name="comment" readonly>${view.content }</textarea>
			</td>
		</tr>
	</table>
	<div>
		<a href="<%=path%>/freeBoard/edit?id=${view.id}"><button type="button" class="btn primary">수정</button></a>
		<a href="javascript:deleteView('${view.id}');"><button type="button" class="btn primary">삭제</button></a>
		<a href="<%=path%>/freeBoard/list"><button type="button" class="btn primary">목록</button></a>
	</div>
	
</div>
<!-- content -->
<%@ include file="../include/footer.jsp" %>