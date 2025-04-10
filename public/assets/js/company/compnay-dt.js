function dbTable() {
    dt_tbl = $("#company_list_tbl").DataTable({
      serverSide: true,
      stateSave: false,
      pageLength: 10,
      ajax: {
        url: company_list_url,
        // data: {},
        beforeSend: function () {},
      },
      columns: [
        {
          name: "index_column",
          data: "index_column",
          orderable: false,
        },
        {
          name: "name",
          data: "name",
        },
        {
          name: "total_users",
          data: "total_users",
        },
        {
          name: "total_generated_url",
          data: "total_generated_url",
        },
  
        {
          name: "total_url_hits",
          data: "total_url_hits",
        },
  
        {
          name: "action",
          data: "action",
          orderable: false,
        },
      ],
      order: [1, "desc"],
      drawCallback: function (settings, json) {
        
      },
    });
  }


  $(document).ready(function(){
    dbTable();
  })