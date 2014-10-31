<p class="lead">
    Our Menu List
        <a href="/admin/editlist" class="btn btn-large btn-error">Show Editable Items!</a>

</p>
<table class="table">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Picture</th>
    </tr>
    {places}
    <tr>
        <td>{code}</td>
        <td>{name}</td>
        <td class="span2">{description}</td>
        <td>{category}</td>
        <td class="span4 offset1"><img src="/data/{pic}" /></td>
    </tr>
    {/places}
</table>
