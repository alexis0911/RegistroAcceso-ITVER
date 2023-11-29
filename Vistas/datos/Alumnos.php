<?php
    include_once($_SESSION["ubicado"]."Clases/Calumno.php");
    $obj=new Calumno(); 
?>
<div class='container'>
    <div class='row'>
        <div class='col'>
			<a class='btn btn-info' href="<?php echo $_SESSION["ubicado"];?>formularios/index.php?form=RegPais">Agregar Pais</a><br/><br/>
			<?php
				$rows = $obj->selectAll();
				if(!empty($rows)){
			?>
            <table id="datos" class='table table-bordered table-striped'>
				<caption>VISTA DE PAISES</caption>
				<thead>
				<tr>
					<th><p>Nombre</p></th>
					<th><p>Procesos</p></th>
				</tr>
				</thead>
                <tbody>
                    <?php 
                        while($row = mysqli_fetch_assoc($rows)){
                    ?>
                    <tr>
                        <!-- PRIMER TD CON LA REFERENCIA -->
                        <td><?php echo $row["nombre"];?></td>   
                        <!-- TD COLUMNA PROCESOS:-->                     

						<td width="50px"> 
							<a href="<?php echo $_SESSION["ubicado"];?>formularios/index.php?form=UpdPais&id=<?php echo $row["idAlumno"];?>"> 
								<i class='fa fa-pencil fa-2x'> </i>
							</a>
							<a href="<?php echo $_SESSION["ubicado"];?>mysql/connector/DelPais.php?val=<?php echo $row["idAlumno"];?>"> 								
                                <i class='fa fa-trash fa-2x text-danger'> </i>    
                            </a>
						</td>
                    </tr>
                    <?php 
                        }
                    ?>
				</tbody>
            
            </table>

            <?php
				}else{
			?>
				<p>No se encontraron resultados</p>
			<?php } ?>
        </div>
    </div>
</div>