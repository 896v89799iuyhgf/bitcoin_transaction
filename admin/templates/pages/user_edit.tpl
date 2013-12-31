<form class="form-horizontal" method="post" action="admin_dashboard">
    <div class="control-group">
        <label class="control-label" for="userName">User Name</label>
        <div class="controls">
            <input type="text" name="userName" id="userName" placeholder="User Name" value="{$user.username}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input type="text" name="password" id="password" placeholder="Address" value="{$user.password}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
            <input type="text" name="email" id="email" placeholder="City" value="{$user.email}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="phone">Phone</label>
        <div class="controls">
            <input type="text" name="phone" id="phone" placeholder="State" value="{$user.phone}">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="status">Status</label>
        <div class="controls">
            <select name="status" id="status">
                <option {if $user.status == 0}selected="selected"{/if} value="0">Disable</option>
                <option {if $user.status == 1}selected="selected"{/if} value="1">Enable</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="user_group">Group</label>
        <div class="controls">
            <select name="user_group" id="user_group">
                <option {if $user.user_group == 'Admin'}selected="selected"{/if} value="Admin">Admin</option>
                <option {if $user.user_group == 'User'}selected="selected"{/if} value="User">User</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Save</button>
            <input type="hidden" name="updateUser" value="1">
            <input type="hidden" name="userid" value="{$user.id}">
        </div>
    </div>
</form>
