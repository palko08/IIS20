
<div class="create_lineup">
    <div class="centering">
        <h4>VYTVORIŤ ROZPIS</h4>
        <input type="number" min=0 placeholder="Počet podií">
        <label for="lineup_date">Den</label>
        <input type="date" id="lineup_date">
        <label for="lineup_time_from">Casovy interval od:</label>
        <input type="time" id="lineup_time_from">
        <label for="lineup_time_to">do:</label>
        <input type="time" id="lineup_time_to">

        <div class="add_timeslots">
            <table class="borders" id="lineup-table">
                <thead>
                <tr>
                    <th class="borders">podium/cas</th>
                    <th class="borders">18:00</th>
                    <th class="borders">19:00</th>
                    <th class="borders">20:00</th></tr>
                </thead>
                <tbody>
                <tr>
                    <td class="borders"><b> PODIUM 1</b> </td>
                    <td>
                        <select name="select_interprets_timeslots">
                            <option value="subfocus">Sub focus</option>
                            <option value="dimension">Dimension</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots">
                            <option value="subfocus">Sub focus</option>
                            <option value="dimension">Dimension</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots">
                            <option value="subfocus">Sub focus</option>
                            <option value="dimension">Dimension</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="borders"><b>PODIUM 2</b>  </td>
                </tr>
                </tbody>
            </table>
            <button class="btn btn-success" id="confirm-lineup">Potvrdiť rozpis</button>
            <button type="submit" class="btn btn-danger" id="remove-lineup">Zrušiť</button>
        </div>
    </div>
</div>