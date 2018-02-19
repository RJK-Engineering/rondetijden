google.charts.load('current', { packages: ['corechart'] });
google.charts.setOnLoadCallback(loadDistance);

var config = {
    width: 800,
    height: 400,
    skipFirstSplit: 0
};

jQuery(function($) {
    $('#distance input[name=distance]').change(function() {
        loadDistance();
    });

    $('#width')[0].value = config.width;
    $('#height')[0].value = config.height;
    $('#skipFirstSplit')[0].checked = config.skipFirstSplit;

    $.each(Object.getOwnPropertyNames(config), function(i, name) {
        $('#'+name).change(function() {
            if ($(this)[0].type == 'checkbox') {
                config[name] = $(this)[0].checked;
            } else {
                config[name] = $(this)[0].value;
            }
            loadDistance();
        });
    });
});


function loadDistance() {
    var distance = $('#distance')[0].distance.value;

    $('#graph').text('');
    csv({
        url: distance + '.csv',
        done: function (data, header) {
            var view = buildView(data, header);
            drawGraph(view, header, distance);
            printContestants(header);
        },
        fail: function () {
            $('#graph').text('No data');
        }
    });
}

function printContestants(header) {
    var contestantsElem = $('#contestants');
    contestantsElem.text('');
    var form = $('<form>');
    $.each(header, function (i, contestant) {
        if (!i) return; // first column contains distances
        // elem.text(contestant);

        var input = $('<input class="contestant" type="checkbox" name="contestants">');
        input[0].value = i;
        input.change(function() {
            // drawGraph('aa');
            // loadDistance();
            // alert($(this)[0].value + ' ' + $(this)[0].checked);
        });
        input.appendTo(form);

        form.appendTo(contestantsElem);
    });
}

function buildView(data, header) {
    var table = new google.visualization.DataTable();
    $.each(header, function (i, col) {
        table.addColumn('number', col);
    });

    if (config.skipFirstSplit) {
        data.shift(); // skip first split at <= 400m
    }
    table.addRows(data);

    return new google.visualization.DataView(table);
}

function drawGraph(view, header, title) {
    filter(view, header);
    var chart = new google.visualization.LineChart(
        document.getElementById('graph')
    );
    chart.draw(view, {
        title: title,
        width: config.width,
        height: config.height,
        // hAxis: { title: 'Afstand' },
        // vAxis: { title: 'Tijd' },
        // legend: 'bottom',
        // chartArea: { width: '50%' }
        // chartArea: { left: '4%' }
    });
}

function filter(view, header) {
    var i = 4;
    var hideColumns = Array.apply(
        0, Array(header.length-1)
    ).map(function() {
        return i++;
    });
    view.hideColumns(hideColumns);
}

function csv(options) {
    $.ajax({
        url: options.url,
    }).done(function (response) {
        var lines = response.split(/[\r\n]+/);
        var header, data = [];
        $.each(lines, function (i, line) {
            if (!line) return;
            var values = line.split(/,/);
            if (options.noHeader || header) {
                $.each(values, function (i, v) {
                    var vp = parseFloat(v);
                    if (vp == v) values[i] = vp;
                });
                data.push(values);
            } else {
                header = values;
            }
        });
        if (options.done)
            options.done(data, header);
    }).fail(function (jqXHR, textStatus) {
        if (options.fail)
            options.fail(jqXHR, textStatus);
    });
}
