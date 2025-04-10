function shortUrlTbl() {
   $("#admin_short_url_list").DataTable({
      serverSide: true,
      stateSave: false,
      pageLength: 10,
      ajax: {
        url: short_url_list,
        // data: {},
        beforeSend: function () {},
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


  $(document).ready(function(){
    shortUrlTbl();
  })