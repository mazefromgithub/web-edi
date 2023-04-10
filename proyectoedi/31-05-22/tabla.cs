DataTable tabla = new DataTable();

// Variables para las columnas y las filas
DataColumn column;
DataRow row;

column = new DataColumn();
column.DataType = System.Type.GetType("System.Int32");
column.ColumnName = "id";
tabla.Columns.Add(column);



column = new DataColumn();
column.DataType = System.Type.GetType("System.String");
column.ColumnName = "Nombre del archivo";
tabla.Columns.Add(column);


column = new DataColumn();
column.DataType = System.Type.GetType("System.edi");
column.ColumnName = "tipo de archivo";
tabla.Columns.Add(column);