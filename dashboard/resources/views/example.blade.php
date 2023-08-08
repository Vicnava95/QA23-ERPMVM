<!doctype html>
<html>
 <body>
   <form method='post' action='/save'>

     <!-- Message -->
     @if(Session::has('message'))
       <p >{{ Session::get('message') }}</p>
     @endif

     <!-- Add/List records -->
     <table border='1' style='border-collapse: collapse;'>
       <tr>
         <th>Username</th>
         <th>Name</th>
         <th>Email</th>
         <th></th>
       </tr>
       <tr>
         <td colspan="4">{{ csrf_field() }}</td>
       </tr>
       <!-- Add -->
       <tr>
         <td><input type='text' name='username'></td>
         <td><input type='text' name='name'></td>
         <td><input type='email' name='email'></td>
         <td><input type='submit' name='submit' value='Add'></td>
       </tr>

       <!-- List -->
       
    </table>
  </form>

  
 
 </body>
</html>