{{ form("producttypes/create", "autocomplete": "off") }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("producttypes", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Guardar", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}

<div class="center scaffold">
    <h2>Nuevo tipo de Actor</h2>

    <div class="clearfix">
        <label for="name">Tipo de Actor</label>
        {{ text_field("name", "size": 24, "maxlength": 70) }}
    </div>

</div>
</form>
