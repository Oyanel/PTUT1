// déterminer l'index des colonnes les colonnes
var colonnes = {};
$("#myTable thead th").each(function(index, th)
{
  colonnes[index] = $(th).text();
}
);

// faire la recherche dans le tableau
$("#search").keyup(function()
{
  var mots = $(this).val().toLowerCase().split(" ");
  $("#myTable tbody tr").each(function(index, tr)
  {
      if (mots[0].length > 0) $(tr).hide(); else $(tr).show();
      $("td", tr).each(function(index, td)
      {
        if (colonnes[index] in {'Number':true, 'Name':true, 'Commune':true})
        {
          for (mot in mots)
          {
            if (mots[mot].length > 0 && $(td).text().toLowerCase().indexOf(mots[mot])>= 0)
            {
              $(tr).show();
              return false;
            }
          }
        }
      });
  });
});
