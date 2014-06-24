<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title>{% block title %}Index{% endblock %}</title>
</head>
<body>
	{% block content %}
	    <h1>Index</h1>
	    <p class="important">
	        Welcome! {{user.username}}
	    </p>
	{% endblock %}

	<p>This email was sent using the <a href="http://cakephp.org">CakePHP Framework</a></p>
</body>
</html>