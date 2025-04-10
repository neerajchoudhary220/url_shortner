function taskCategoryDBtbl() {
    task_category_tbl = $("#task_category_tbl").DataTable({
      serverSide: true,
      stateSave: false,
      pageLength: 10,
      ajax: {
        url: task_category_list_url,
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
          name:'task',
          data: "task",
          orderable: false,
        }
        ,
        {
          name: "status",
          data: "status",
        },
    
  
        {
          name: "action",
          data: "action",
          orderable: false,
        },
      ],
      order: [1, "desc"],
      drawCallback: function (settings, json) {
        //Click delete button
        $(document).find('[data-bs-toggle="tooltip"]').tooltip();
  
        $(".dltBtn").on("click", function () {
          const delete_url = $(this).val();
          function deleteReq() {
            custom.functions.deleteTblData(delete_url,task_category_tbl);
          
          }
          custom.functions.deleteTask(deleteReq);
        });

     
  
      
      },
    });
  }
  
  $(document).ready(function () {
    taskCategoryDBtbl();
    $("#upload_task_categories_btn,#sync_task_categories_btn").on("click", function(){
      const sys_value = $(this).attr("value");
      var $syncButton = $(this);
      const title = $(this).attr("data-title");
      runPythonScript($syncButton,sys_value,task_categories_python_script_url,title,task_category_tbl)
    })

  });
  