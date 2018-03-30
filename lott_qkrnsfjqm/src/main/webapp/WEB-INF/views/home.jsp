<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page session="false" %>
<%@ page contentType="text/html;charset=UTF-8" %>
<html>
<head>
	<title>Home</title>
	<script type="text/javascript">
		document.location.href="/qkrnsfjqm/main/index";
	</script>
</head>
<body>
<h1>
	Hello world!  
</h1>

<P>  The time on the server is ${serverTime}. </P>
<table>
<c:forEach items="${users }" var="row">
    <tr>
        <td>${row.id }</td>
        <td>${row.name }</td>
    </tr>
</c:forEach>
</table>
</body>
</html>
