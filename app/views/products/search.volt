{{ content() }}

<ul class="pager">
    <li class="previous">
        {{ link_to("Actores", "&larr; Go Back") }}
    </li>
    <li class="next">
        {{ link_to("products/new", "Nuevo Actor") }}
    </li>
</ul>

{% for product in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Tipo de Actor</th>
            <th>Actor</th>
           
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ product.id }}</td>
            <td>{{ product.getProductTypes().name }}</td>
            <td>{{ product.name }}</td>
            <td width="7%">{{ link_to("products/edit/" ~ product.id, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("products/delete/" ~ product.id, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("products/search", '<i class="icon-fast-backward"></i> Primero', "class": "btn") }}
                    {{ link_to("products/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Anterior', "class": "btn") }}
                    {{ link_to("products/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Siguiente', "class": "btn") }}
                    {{ link_to("products/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Último', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% else %}
    No existen actores
{% endfor %}
