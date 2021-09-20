$(() => {
  function formatDocTable(d) {
    // `d` is the original data object for the row
    return `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
			<tr>
				<td>Weight:</td>
				<td>${d.weight} kg</td>
				<td>Temperature:</td>
				<td>${d.temp} &deg;C</td>
				<td>Blood Pressure:</td>
				<td>${d.bp} (mmHg)</td>
			</tr>
			<tr>
				<td>Pulse:</td>
				<td>${d.pulse} bps</td>
				<td>Respiration:</td>
				<td>${d.resp}</td>
			</tr>
			<tr>
				<td>
					<a href="/doc.php?id=${d.id}" class="btn btn-dark">View Documentation</a>
				</td>
			</tr>
		</table>`;
  }
  function formatPatientsTable(d) {
    // `d` is the original data object for the row
    return `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
			<tr>
				<td>Full name:</td>
				<td>${d.name}</td>
			</tr>
			<tr>
				<td>Phone number:</td>
				<td>${d.phone_number}</td>
			</tr>
			<tr>
				<td><b>${d.notes}</b></td>
			</tr>
			<tr>
				<td>
					<a href="/documentation.php?category=${d.category}&hospital_number=${d.hospital_number}" class="btn btn-dark">Enter Documentation</a>
				</td>
				<td>
					<a href="/patient.php?id=${d.id}&hospital_number=${d.hospital_number}" class="btn btn-dark">Edit</a>
				</td>
			</tr>
		</table>`;
  }

  const table = $("#patients-table").DataTable({
    ajax: {
      url: "/api/patients.php",
      dataSrc: "",
    },
    columns: [
      {
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: "",
      },
      { data: "hospital_number" },
      { data: "name" },
      { data: "category" },
    ],
  });

  $("#patients-table tbody").on("click", "td.details-control", function () {
    var tr = $(this).closest("tr");
    var row = table.row(tr);

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide();
      tr.removeClass("shown");
    } else {
      // Open this row
      row.child(formatPatientsTable(row.data())).show();
      tr.addClass("shown");
    }
  });

  const docTable = $("#documentation-table").DataTable({
    ajax: {
      url: "/api/documentations.php",
      dataSrc: "",
    },

    columns: [
      {
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: "",
      },
      { data: "hospital_number" },
      { data: "name" },
      { data: "date" },
    ],
  });

  $("#documentation-table tbody").on(
    "click",
    "td.details-control",
    function () {
      var tr = $(this).closest("tr");
      var row = docTable.row(tr);

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass("shown");
      } else {
        // Open this row
        row.child(formatDocTable(row.data())).show();
        tr.addClass("shown");
      }
    }
  );
});
