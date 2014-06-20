<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
		<title>{% block title %}{% endblock %}</title>
</head>
<body>

		{% block content %}
		    Content of the page...
		{% endblock %}

	<p>This email was sent using the <a href="http://cakephp.org">CakePHP Framework</a></p>
</body>
</html>