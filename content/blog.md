Hello there! This is blog page. Check out this blog entries:

<ul>
    {% for post in posts %}
    <li>
        <a href="{{ post | replace({"blog/": ""}) }}">
            {{ post }}
        </a>
    </li>
    {% endfor %}
</ul>