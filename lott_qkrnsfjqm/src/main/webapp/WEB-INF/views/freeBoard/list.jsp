<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ include file="../include/header.jsp" %>

<div class="container">
	<table class="table">
		<tr>
			<th>글번호</th>
			<th>작성자</th>
			<th>제목</th>
			<th>조회수</th>			
		</tr>
		<c:forEach items="${list }" var="bList">
			<tr>
				<td>${bList.id }</td>
				<td>${bList.name }</td>
				<td><a href="<%=path%>/freeBoard/view?id=${bList.id }">${bList.title }</a></td>
				<td>${bList.hit }</td>
			</tr>
		</c:forEach>		
	</table>
	
	<div>
		<a href="<%=path%>/freeBoard/write">글쓰기</a>
	</div>
</div>
<%@ include file="../include/footer.jsp" %>