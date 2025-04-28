function shortUrlTbl() {
    $("#admin_short_url_list").DataTable({
        serverSide: true,
        stateSave: false,
        pageLength: 10,
        ajax: {
            url: short_url_list,
            // data: {},
            beforeSend: function () { },
        },
        columns: [

            {
                name: "short_url",
                data: "short_url",
                orderable: false,

            },
            {
                name: "original_url",
                data: "original_url",
            },
            {
                name: "clicks",
                data: "clicks",
            },

            {
                name: "date",
                data: "date",
            },


        ],
        order: [0, "desc"],
        drawCallback: function (settings, json) {

        },
    });
}


$(document).ready(function () {
    shortUrlTbl();

    //click to export csv button
    $("#export_csv_btn").on("click", function () {
        exportCsv();
    });

    const exportCsv = () => {
        const dt = $("#admin_short_url_list").DataTable()
        const data = dt.rows().data().toArray();
        // Get only the columns you want from DataTable
        const filteredData = dt.rows().data().toArray().map(row => {
            return {
                'Short Url': row.short_url,
                'Long Url': row.original_url,
                'Hits': row.clicks,
                'Created On': row.date
            };
        });

        $.ajax({
            method: 'POST',
            url: export_csv_url,
            data: { 'data': filteredData },
            beforeSend: function () {
            },
            success: function () {
                alert(res.msg)
                // polling();
            }
        })
    }

    // let pollCount = 0;
    // const maxPolls = 10;
    // const pollInterval = 2000; // 2 seconds
    // let pollingActive = true;

    // const polling = () => {
    //     if (!pollingActive || pollCount >= maxPolls) {
    //         console.log(pollCount >= maxPolls ? 'Maximum poll count reached' : 'Polling stopped by condition');
    //         return;
    //     }

    //     pollCount++;
    //     console.info(`Polling attempt ${pollCount} of ${maxPolls}`);
    //     downloadCsvFile();
    // }

    // // Download CSV file
    // const downloadCsvFile = () => {
    //     $.ajax({
    //         url: download_csv_file_url,
    //         method: 'get',
    //         success: function(res) {
    //             console.info(res);

    //             if (res) {
    //                 console.log('Received successful response - stopping polling');
    //                 window.location.href=res.url
    //                 console.info(res.url)
    //                 pollingActive = false;
    //                 return;
    //             }

    //             // Schedule next poll if still active
    //             if (pollingActive) {
    //                 setTimeout(polling, pollInterval);
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Polling error:', error);
    //             // Schedule next poll even if there's an error (if still active)
    //             if (pollingActive) {
    //                 setTimeout(polling, pollInterval);
    //             }
    //         }
    //     });
    // }



})



