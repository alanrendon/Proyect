stm_bm(["menu3ca8",430,"./menus/","blank.gif",2,"","",0,0,0,0,0,1,1,1,"","",0],this);
stm_bp("p0",[0,4,0,0,0,2,16,0,100,"",-2,"",-2,90,0,0,"#000000","transparent","",3,0,0,"#ffffff"]);
stm_ai("p0i0",[0,"Inventarios  ","","",-1,-1,0,"","_self","","","bullet1.gif","bullet2.gif",16,16,0,"","",0,0,0,0,1,"#73a8b7",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000","bold 12pt Arial","bold 12pt Arial",0,0]);
stm_bp("p1",[1,4,0,0,0,3,16,0,80,"",-2,"",-2,60,0,0,"#000000","#ffffff","",3,1,1,"#73a8b7"]);
stm_aix("p1i0","p0i0",[0,"Existencias fin de mes","","",-1,-1,0,"./ped_inv_con.php","mainFrame","","","search.gif","search.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#acd2dd",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#333333","12pt Arial","12pt Arial"]);
stm_aix("p1i1","p1i0",[0,"Auxiliar de Inventario","","",-1,-1,0,"AuxiliarInventario.php"]);
stm_aix("p1i2","p1i0",[0,"Precios por kilo diario del huevo","","",-1,-1,0,"HuevoPrecios.php"]);
stm_ep();
stm_ai("p0i1",[6,1,"#cccccc","",0,0,0]);
stm_aix("p0i2","p0i0",[0,"Cat�logos  "]);
stm_bpx("p2","p1",[]);
stm_aix("p2i0","p1i0",[0,"Cat�logo de Compa��as","","",-1,-1,0,"./fac_cia_con.php"]);
stm_aix("p2i1","p1i0",[0,"Cat�logo de Proveedores","","",-1,-1,0,"./fac_prov_con.php"]);
stm_aix("p2i2","p1i0",[0,"Cat�logo de Materia Prima","","",-1,-1,0,"MateriasPrimasCatalogo.php"]);
stm_aix("p2i3","p1i0",[0,"Cat�logo de Precios por Proveedor","","",-1,-1,0,"./fac_dmp_con.php"]);
stm_ep();
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Listados  "]);
stm_bpx("p3","p1",[]);
stm_aix("p3i0","p1i0",[0,"Compras Anuales por Proveedor","","",-1,-1,0,"./fac_pro_anu_v2.php"]);
stm_aix("p3i1","p1i0",[0,"Consumos Anuales por Producto","","",-1,-1,0,"./fac_con_anu_v2.php"]);
stm_aix("p3i2","p1i0",[0,"Consumos Anuales por Compa��a","","",-1,-1,0,"./fac_con_cia_v2.php"]);
stm_aix("p3i3","p1i0",[0,"Comparativo de Promedio de Consumo Anual","","",-1,-1,0,"./bal_con_anu.php"]);
stm_aix("p3i4","p1i0",[0,"Comparativo de Consumos Anual","","",-1,-1,0,"./bal_com_con_anu.php"]);
stm_aix("p3i5","p1i0",[0,"Provisi�n Mensual de Pedidos","","",-1,-1,0,"./ped_pro_men.php"]);
stm_aix("p3i6","p1i0",[0,"Entradas de Producto por Proveedor","","",-1,-1,0,"./fac_pro_pro.php"]);
stm_aix("p3i7","p1i0",[0,"Promedios de Consumo","","",-1,-1,0,"./fac_pro_con_v2.php"]);
stm_aix("p3i8","p1i0",[0,"Cat�logo de Costos","","",-1,-1,0,"./fac_costos_con.php"]);
stm_aix("p3i9","p1i0",[0,"Consulta de Producci�n","","",-1,-1,0,"./pan_pro_con.php"]);
stm_aix("p3i10","p1i0",[0,"Consulta de Existencias","","",-1,-1,0,"./ped_exi_mes.php"]);
stm_aix("p3i11","p1i0",[0,"�ltimo d�a capturado de consumos","","",-1,-1,0,"UltimoDiaCapturadoConsumos.php"]);
stm_aix("p3i12","p1i0",[0,"Surtido de productos mensual","","",-1,-1,0,"ReporteProductosMensual.php"]);
stm_ep();
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Consultas  "]);
stm_bpx("p4","p1",[]);
stm_aix("p4i0","p1i0",[0,"Consulta de productos de facturas","","",-1,-1,0,"FacturasProductosConsulta.php"]);
stm_aix("p4i1","p1i0",[0,"Variaci�n Anual de Precios de Compra","","",-1,-1,0,"VariacionAnualPreciosCompra.php"]);
stm_ep();
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Pedidos  "]);
stm_bpx("p5","p1",[]);
stm_aix("p5i0","p1i0",[0,"Sistema de Pedidos Autom�ticos","","",-1,-1,0,"PedidosAutomaticos.php","mainFrame","","","","",0,0]);
stm_aix("p5i1","p5i0",[0,"Sistema de Pedidos al Corte","","",-1,-1,0,"PedidosAlCorte.php"]);
stm_aix("p5i2","p5i0",[0,"Sistema de Pedidos Manuales","","",-1,-1,0,"PedidosManual.php"]);
stm_aix("p5i3","p5i0",[0,"Porcentajes de Distribuci�n de Pedidos","","",-1,-1,0,"PorcentajesPedidosProveedores.php"]);
stm_aix("p5i4","p5i0",[0,"Asignaci�n de Productos por Proveedor","","",-1,-1,0,"DistribucionProductosProveedores.php"]);
stm_aix("p5i5","p5i0",[0,"Pedidos de Panader�as","","",-1,-1,0,"PedidosPanaderias.php"]);
stm_aix("p5i6","p5i0",[0,"Pedidos de Panader�as Mensual","","",-1,-1,0,"PedidosPanaderiasMes.php"]);
stm_aix("p5i7","p5i0",[0,"Pedidos de Panader�as Especial","","",-1,-1,0,"PedidosPanaderiasEspecial.php"]);
stm_aix("p5i8","p5i0",[0,"Consulta de Pedidos","","",-1,-1,0,"PedidosConsulta.php"]);
stm_aix("p5i9","p5i0",[0,"Existencia estimada menor al corte","","",-1,-1,0,"ExistenciaEstimadaMenorAlCorte.php"]);
stm_aix("p5i10","p5i0",[0,"Existencia estimada mayor al consumo mensual","","",-1,-1,0,"ExistenciaEstimadaInventario.php"]);
stm_aix("p5i11","p5i0",[0,"Actualizar Consumos Mensuales","","",-1,-1,0,"./bal_act_con_v2.php"]);
stm_aix("p5i12","p5i0",[0,"Pedidos por Proveedor","","",-1,-1,0,"./ped_fac_pro.php"]);
stm_aix("p5i13","p1i0",[0,"Simulaci�n de Pedidos Autom�ticos","","",-1,-1,0,"SimulacionPedidosAutomaticosV2.php"]);
stm_ep();
stm_aix("p0i9","p0i1",[]);
stm_aix("p0i10","p0i0",[0,"Cartas  ","","",-1,-1,0,"",""]);
stm_bpx("p6","p1",[1,4,0,0,0,3,0]);
stm_aix("p6i0","p5i0",[0,"Memorandums","","",-1,-1,0,"./ban_gen_mem.php"]);
stm_aix("p6i1","p5i0",[0,"Memorandum de Pedidos","","",-1,-1,0,"./ped_mem_ped.php"]);
stm_aix("p6i2","p5i0",[0,"Memorandum de Pedidos (por consumos)","","",-1,-1,0,"./ped_mem_ped_v2.php"]);
stm_ep();
stm_aix("p0i11","p0i1",[]);
stm_aix("p0i12","p0i0",[0,"Quejas  "]);
stm_bpx("p7","p6",[]);
stm_aix("p7i0","p5i0",[0,"Alta de Quejas de Pedidos","","",-1,-1,0,"FormularioQuejas.php"]);
stm_aix("p7i1","p5i0",[0,"Consulta de Quejas de Pedidos","","",-1,-1,0,"ConsultaQuejas.php","_self"]);
stm_aix("p7i2","p5i0",[0,"Cat�logo de Clasificaci�n de Quejas","","",-1,-1,0,"CatalogoClasificacionQuejas.php"]);
stm_ep();
stm_ep();
stm_em();