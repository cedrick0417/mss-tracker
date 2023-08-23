<div class="home-modal-container modal">
  <div class="home-modal">
    <div class="home-modal-content">
      <div class="home-modal-header">
        <h2>Website Info</h2>
        <button class="home-modal-close"> <i class='fa fa-close'></i>  </button>
      </div>
      <div class="row-details">
        <div class="">
          <div>
            <label for="status">Merchant Status</label>
            <select name="status" id="status">
              <option value="NEW">NEW</option>
              <option value="PENDING">PENDING</option>
              <option value="BOARDED">BOARDED</option>
              <option value="QUALITY_CONTROL">QUALITY CONTROL</option>
              <option value="TESTING_MODE">TESTING MODE</option>
              <option value="INACTIVE">INACTIVE</option>
              <option value="ACTIVE">ACTIVE</option>
              <option value="RED">RED</option>
              <option value="FAILED">FAILED</option>
              <option value="PAYSHIELD">PAYSHIELD</option>
              <option value="100URLS">100 URLS</option>
            </select>
          </div>
          <div>
            <label for="row-mid">MID</label>
            <input type="text" id="row-mid" class="row-mid" readonly>
          </div>
          <div>
            <label for="row-website-address">Website Address / MID</label>
            <input type="text" id="row-website-address" class="row-website-address" readonly>
          </div>
          <div>
            <label for="row-api-url">Api URL</label>
            <input type="text" id="row-api-url" class="row-api-url" readonly>
          </div>
          <div>
            <label for="row-api-login">API Login</label>
            <input type="text" id="row-api-login" class="row-api-login" readonly>
          </div>
          <div>
            <label for="row-api-password">API Password</label>
            <input type="text" id="row-api-password" class="row-api-password" readonly>
          </div>
          <div>
            <label for="row-gateway-url">Gateway URL</label>
            <input type="text" id="row-gateway-url" class="row-gateway-url" readonly>
          </div>
          <div>
            <label for="row-gateway-name">Gateway Name</label>
            <input type="text" id="row-gateway-name" class="row-gateway-name" readonly>
          </div>
          <div>
            <label for="row-gateway-username">Gateway Username</label>
            <input type="text" id="row-gateway-username" class="row-gateway-username" readonly>
          </div>
          <div>
            <label for="row-gateway-password">Gateway Password</label>
            <input type="text" id="row-gateway-password" class="row-gateway-password" readonly>
          </div>
          <div>
            <label for="row-process-type">Process Type</label>
            <input type="text" id="row-process-type" class="row-process-type" readonly>
          </div>
          <div>
            <label for="row-or-capability">OR Capability</label>
            <input type="text" id="row-or-capability" class="row-or-capability" readonly>
          </div>
        </div>
        <div class="">
          <div>
            <label for="row-date-added">Date Added:</label>
            <input type="text" id="row-date-added" class="row-date-added" readonly>
          </div>
          <div>
            <label for="row-last-modified">Last Modified:</label>
            <input type="text" id="row-last-modified" class="row-last-modified" readonly>
          </div>
          <div>
            <label for="category">Category</label>
            <select name="category" id="category">
              <option value="ADULT">ADULT</option>
              <option value="NON-ADULT">NON-ADULT</option>
            </select>
          </div>
          <div>
            <label for="referring-agent">Referring Agent</label>
            <select name="referring-agent" id="referring-agent">
              <option value="ICAN_REFER">iCAN Refer / ICAN REFER</option>
              <option value="MARK">Mark Tiarra / MARK TIARRA</option>
              <option value="MFMDO">MFMDO / MFMDOgrp</option>
              <option value="MFMDO2">MFMDO2 / MFMDOgrp2</option>
              <option value="MFMDO4">MFMDO4 / MFMDOgrp4</option>
              <option value="OMAR">Omar Rodriguez / OMAR RODRIGUEZ</option>
              <option value="test-agent">Test Agent Edited / Test Group</option>
              <option value="no-refer">No referring agent</option>
            </select>
          </div>
          <div>
            <label for="staff-user">Staff User</label>
            <select name="staff-user" id="staff-user">
              <!-- <option value="ICAN_REFER">iCAN Refer / ICAN REFER</option>
                <option value="MARK">Mark Tiarra / MARK TIARRA</option>
                <option value="MFMDO">MFMDO / MFMDOgrp</option>
                <option value="MFMDO2">MFMDO2 / MFMDOgrp2</option>
                <option value="MFMDO4">MFMDO4 / MFMDOgrp4</option>
                <option value="OMAR">Omar Rodriguez / OMAR RODRIGUEZ</option>
                <option value="test-agent">Test Agent Edited / Test Group</option>
                <option value="no-refer">No referring agent</option> -->
            </select>
          </div>
          <div>
            <label for="row-is-ACH">Is ACH</label>
            <input type="text" id="row-is-ACH" class="row-is-ACH" readonly>
          </div>
          <div>
            <label for="row-one-time-setup">One Time Setup</label>
            <input type="text" id="row-one-time-setup" class="row-one-time-setup" readonly>
          </div>
          <div>
            <label for="row-ACH-refund-fee">ACH Refund Fee</label>
            <input type="text" id="row-ACH-refund-fee" class="row-ACH-refund-fee" readonly>
          </div>
          <div>
            <label for="row-refund-fee">Refund Fee</label>
            <input type="text" id="row-refund-fee" class="row-refund-fee" readonly>
          </div>
          <div>
            <label for="row-industry-type">Industry Type</label>
            <input type="text" id="row-industry-type" class="row-industry-type" readonly>
          </div>
          <div>
            <label for="row-extra-field">Extra Field</label>
            <input type="text" id="row-extra-field" class="row-extra-field" readonly>
          </div>
        </div>
        <!-- </div> -->
        <!-- <div class="row-details"> -->
      </div>
      <div class="add-descriptor-wrapper">
        <div class="add-descriptor-container">
          <input class="add-descriptor-input" type="text" placeholder="">
          <button class="add-descriptor-button">Add Descriptor</button>
        </div>
        <div class="list-descriptor">
          <table>
            <thead>
              <tr>
                <th></th>
                <th>Descriptor-text</th>
                <th>Descriptor-date-added</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox" name="" id=""></td>
                <td>test-descriptor</td>
                <td>2023-03-22 12:19:28</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="add-descriptor-button-wrap">
          <button>Save Changes</button>
          <button>Remove Checked</button>
        </div>
        <div class="add-comment-wrapper">
          <div class="add-comment-container">
            <h2>Logs & Comments 
              <i class="fa-solid fa-chevron-right"></i>
            </h2>
            <button class="add-comment-button">Add Comment</button>
          </div>
          <div class="list-comment">
            <table>
              <thead>
                <tr>
                  <th>Comment</th>
                  <th>Date Added</th>
                  <th>Username</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Test pending update initial email sent</td>
                  <td>2022-10-26 01:03:12</td>
                  <td>admin</td>
                </tr>
                <tr>
                  <td>Non-member Merchant refund request initiated</td>
                  <td>2018-10-26 01:03:12</td>
                  <td>system</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
