// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, or any plugin's
// vendor/assets/javascripts directory can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// compiled file. JavaScript code in this file should be added after the last require_* statement.
//
// Read Sprockets README (https://github.com/rails/sprockets#sprockets-directives) for details
// about supported directives.
//
//= require rails-ujs

$(document).ready(function() {
  $(function () {
    setInterval(function () {
        $.get("http://localhost/emails/get_emails", function (data) {
            $("#urlsTotal").html(data["urlsTotal"]);
            $("#totalEmails").html(data["emailsTotal"]);
            $("#urlsVisitadas").html(data["urlsVisited"]);


            var tabela = $("<table />");
            for (var i = 0; i < data['emails'].length; i++) {
                coluna = $(tabela[0].insertRow(-1));
                var popularTabela = $("<td />");
                cell.html(data['emails'][i]['Emails']['emails']);
                coluna.append(popularTabela);
            }

            var preencher = $("#tabela_emails");
            preencher.html("");
            preencher.append(tabela);
        });
    }, 1000);
  });
});