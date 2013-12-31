<form class="form-horizontal" method="post" action="admin_dashboard">
    <div class="control-group">
        <label class="control-label" for="registerUsername">Username</label>
        <div class="controls">
            <input type="text" name="registerUsername" id="registerUsername" placeholder="Username">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="registerPassword">Password</label>
        <div class="controls">
            <input type="password" name="registerPassword" id="registerPassword" placeholder="Password">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="registerEmail">Email</label>
        <div class="controls">
            <input type="text" name="registerEmail" id="registerEmail" placeholder="Email">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="registerPhoneNumber">Phone Number</label>
        <div class="controls">
            <input type="text" name="registerPhoneNumber" id="registerPhoneNumber" placeholder="Phone Number">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="status">Status</label>
        <div class="controls">
            <select name="status" id="status">
                <option value="0">Disable</option>
                <option value="1">Enable</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="group">Group</label>
        <div class="controls">
            <select name="user_group" id="user_group">
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="hidden" name="add_user" value="1">
            <button type="submit" class="btn">Add</button>
        </div>
    </div>
</form>
