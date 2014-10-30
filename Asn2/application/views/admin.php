<p class="lead">
    Our Menu List
        <a href="/admin/list2" class="btn btn-large btn-error">Show Editable Items!</a>

</p>
<table class="table">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Description</th>
        <th>Picture</th>
    </tr>
    {places}
    <tr>
        <td>{code}</td>
        <td>{name}</td>
        <td class="span3">{description}</td>
        <td class="span5 offset1"><img src="/data/{pic}" /></td>
    </tr>
    {/places}
</table>
