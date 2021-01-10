 <form id="form-reset-password" name="form-reset" class="form-horizontal" >
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Ubah Password</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <input type="hidden" id="id_user" value="{{ $data['id'] }}"/>
                 <label for="email">Email</label> 
                 <div class="input-group mb-3">
                     <input type="text" disabled class="form-control" id="email" aria-describedby="basic-addon3" placeholder="User's Email" value="{{ $data['email'] }}">
                     <div class="input-group-append">
                         <div class="input-group-text">
                             <span class="fas fa-envelope"></span>
                         </div>
                     </div>
                 </div>
                 <label for="password">New Password</label>
                 <div class="input-group mb-3">
                     <input type="password" class="form-control" name="pwd" id="password" aria-describedby="basic-addon3" placeholder="Enter new password">
                     <div class="input-group-append">
                         <div class="input-group-text">
                             <span class="fas fa-lock"></span>
                         </div>
                     </div>
                 </div>
                 <label for="password-confirmation" >Confirmation Password</label>
                 <div class="input-group mb-3">
                     <input type="password" class="form-control" name="pwd" id="password-confirmation" aria-describedby="basic-addon3" placeholder="Re-enter password">
                     <div class="input-group-append" >
                         <div class="input-group-text">
                             <span class="fas fa-lock"></span>
                         </div>
                     </div>
                 </div>
                 <input type="checkbox" id="show-pwd"> <label for="show-pwd">Show Password</label>


             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-info">Kirim</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </form>
