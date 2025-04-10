function memberDt() {
    $("#admin_team_members_list").DataTable({
       serverSide: true,
       stateSave: false,
       pageLength: 10,
       ajax: {
         url: team_member_url,
         beforeSend: function () {},
       },
       columns: [
       
         {
           name: "name",
           data: "name",
           orderable: true,
 
         },
         {
           name: "email",
           data: "email",
         },
         {
           name: "role",
           data: "role",
         },
   
         {
           name: "total_generated_url",
           data: "total_generated_url",
         },
   
         {
           name: "total_hits",
           data: "total_hits",
         },
      
       ],
       order: [0, "desc"],
       drawCallback: function (settings, json) {
         
       },
     });
   }
 
 
   $(document).ready(function(){
     memberDt();
   })