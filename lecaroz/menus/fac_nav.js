stm_bm(["menu0890",430,"./menus/","blank.gif",0,"","",0,0,0,0,0,1,0,0,"","",0],this);
stm_bp("p0",[0,4,0,0,0,2,16,0,100,"",-2,"",-2,90,0,0,"#000000","transparent","",3,0,0,"#ffffff"]);
stm_ai("p0i0",[0,"Facturas  ","","",-1,-1,0,"","_self","","","bullet1.gif","bullet2.gif",16,16,0,"","",0,0,0,0,1,"#73a8b7",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#ffffff","#000000","bold 12pt Arial","bold 12pt Arial",0,0]);
stm_bp("p1",[1,4,0,0,0,3,16,7,70,"",-2,"",-2,60,0,0,"#000000","#ffffff","",3,1,1,"#73a8b7"]);
stm_aix("p1i0","p0i0",[0,"Materia Prima","","",-1,-1,0,"","","","","bullet2.gif","bullet2.gif",16,16,0,"arrow_r.gif","arrow_r.gif",7,7,0,0,1,"#b3ccd3",0,"#b3ccd3",0,"","",3,3,0,0,"#ffffff","#ffffff","#000000"]);
stm_bpx("p2","p1",[1,2,0,0,0,3,16,0]);
stm_aix("p2i0","p0i0",[0,"Facturas Materia Prima","","",-1,-1,0,"FacturaMateriaPrima.php","mainFrame","","","insert2.gif","insert2.gif",16,16,0,"","",0,0,0,0,1,"#ebf8ff",0,"#acd2dd",0,"","",3,3,0,0,"#ffffff","#ffffff","#333333","#333333","12pt Arial","12pt Arial"]);
stm_aix("p2i1","p2i0",[0,"Facturas Materia Prima Especial","","",-1,-1,0,"FacturaMateriaPrimaEspecial.php"]);
stm_aix("p2i2","p2i0",[0,"Facturas Multiples","","",-1,-1,0,"./fac_fac_mul.php"]);
stm_aix("p2i3","p2i0",[0,"Productos Pendientes de Ingresar a Inventario","","",-1,-1,0,"./fac_ing_inv.php"]);
stm_aix("p2i4","p2i0",[0,"Consulta de remisiones de huevo","","",-1,-1,0,"HuevoConsulta.php"]);
stm_aix("p2i5","p2i0",[0,"Consulta de Productos Pendientes","","",-1,-1,0,"./fac_ppi_con.php","mainFrame","","","search.gif","search.gif"]);
stm_aix("p2i6","p2i5",[0,"Listado de Facturas de Materia Prima","","",-1,-1,0,"./fac_fac_list.php","mainFrame","Consulta"]);
stm_ep();
stm_aix("p1i1","p1i0",[0,"Gas"]);
stm_bpx("p3","p2",[]);
stm_aix("p3i0","p2i0",[0,"Facturas de Gas","","",-1,-1,0,"./fac_glp_cap.php"]);
stm_aix("p3i1","p2i6",[0,"Listado de facturas de gas","","",-1,-1,0,"./fac_gas_list.php"]);
stm_aix("p3i2","p2i5",[0,"Surtido de Gas Mensual","","",-1,-1,0,"./bal_gas_ent_men.php"]);
stm_aix("p3i3","p2i0",[0,"Tanques de Gas","","",-1,-1,0,"TanquesGas.php","mainFrame","","","insert.gif","insert.gif"]);
stm_ep();
stm_aix("p1i2","p1i0",[0,"Otros"]);
stm_bpx("p4","p2",[]);
stm_aix("p4i0","p2i0",[0,"Facturas de proveedores varios","","",-1,-1,0,"FacturaProveedoresVarios.php"]);
stm_aix("p4i1","p2i0",[0,"Facturas de Proveedores Especiales","","",-1,-1,0,"FacturasProveedoresEspeciales.php"]);
stm_aix("p4i2","p2i0",[0,"Facturas de Luz","","",-1,-1,0,"./fac_luz_cap.php"]);
stm_aix("p4i3","p2i0",[0,"Facturas de Arrendadoras","","",-1,-1,0,"./fac_arren_cap.php"]);
stm_ep();
stm_aix("p1i3","p1i0",[0,"Consultas"]);
stm_bpx("p5","p2",[]);
stm_aix("p5i0","p2i5",[0,"Consulta de facturas","","",-1,-1,0,"FacturasConsulta.php"]);
stm_aix("p5i1","p2i5",[0,"Consulta de productos de facturas","","",-1,-1,0,"FacturasProductosConsulta.php"]);
stm_aix("p5i2","p2i0",[0,"Validar facturas","","",-1,-1,0,"ValidarFacturas.php"]);
stm_aix("p5i3","p2i0",[0,"Cancelar facturas validadas","","",-1,-1,0,"ValidarFacturasCancelar.php"]);
stm_aix("p5i4","p2i0",[0,"Captura de Pagos Fijos","","",-1,-1,0,"./ban_cap_che_fij.php"]);
stm_aix("p5i5","p2i5",[0,"Facturas pendientes por cambiar","","",-1,-1,0,"./fac_pen_con.php"]);
stm_aix("p5i6","p2i5",[0,"Facturas pendientes de pago","","",-1,-1,0,"FacturasPendientes.php"]);
stm_aix("p5i7","p2i5",[0,"Facturas pendientes de pago (general)","","",-1,-1,0,"FacturasPendientesPagoCias.php"]);
stm_aix("p5i8","p2i5",[0,"Listado de movimientos<BR>operados a proveedores","","",-1,-1,0,"./fac_prov_list.php"]);
stm_ep();
stm_aix("p1i4","p1i0",[0,"Aclaraciones","","",-1,-1,0,"","_self"]);
stm_bpx("p6","p2",[]);
stm_aix("p6i0","p2i0",[0,"Aclaraci�n de Facturas de Proveedores","","",-1,-1,0,"AclaracionFacturasProveedores.php","_self"]);
stm_ep();
stm_aix("p1i5","p2i0",[0,"Guardar CFD\'s de proveedores","","",-1,-1,0,"GuardarCFD.php"]);
stm_ep();
stm_ai("p0i1",[6,1,"#cccccc","",0,0,0]);
stm_aix("p0i2","p0i0",[0,"Cat�logos  "]);
stm_bpx("p7","p1",[]);
stm_aix("p7i0","p1i0",[0,"Compa��as"]);
stm_bpx("p8","p2",[]);
stm_aix("p8i0","p3i3",[0,"Cat�logo de compa��as","","",-1,-1,0,"CompaniasCatalogo.php"]);
stm_ep();
stm_aix("p7i1","p1i0",[0,"Proveedores"]);
stm_bpx("p9","p2",[]);
stm_aix("p9i0","p3i3",[0,"Alta de Proveedor","","",-1,-1,0,"ProveedoresAlta.php"]);
stm_aix("p9i1","p2i0",[0,"Modificar Proveedor","","",-1,-1,0,"ProveedoresModificacion.php","mainFrame","","","edit.gif","edit.gif"]);
stm_aix("p9i2","p2i5",[0,"Consultas","","",-1,-1,0,"ProveedoresConsulta.php"]);
stm_ep();
stm_aix("p7i2","p1i0",[0,"Puestos  "]);
stm_bpx("p10","p2",[]);
stm_aix("p10i0","p3i3",[0,"Alta de puestos","","",-1,-1,0,"./fac_pue_altas.php"]);
stm_aix("p10i1","p9i1",[0,"Consulta y modificacion<BR>de puestos","","",-1,-1,0,"./fac_pue_con.php","mainFrame","","","search.gif"]);
stm_ep();
stm_aix("p7i3","p1i0",[0,"Horarios  "]);
stm_bpx("p11","p2",[]);
stm_aix("p11i0","p3i3",[0,"Alta de horarios","","",-1,-1,0,"./fac_hor_altas.php"]);
stm_aix("p11i1","p10i1",[0,"Consulta y modificaci�n<BR>de Horarios","","",-1,-1,0,"./fac_hor_con.php"]);
stm_ep();
stm_aix("p7i4","p1i0",[0,"Turnos  "]);
stm_bpx("p12","p2",[]);
stm_aix("p12i0","p3i3",[0,"Alta de turnos","","",-1,-1,0,"./fac_tur_altas.php"]);
stm_aix("p12i1","p10i1",[0,"Consulta y modificaci�n<BR>de Turnos","","",-1,-1,0,"./fac_tur_con.php"]);
stm_ep();
stm_aix("p7i5","p1i0",[0,"Productos  "]);
stm_bpx("p13","p2",[]);
stm_aix("p13i0","p3i3",[0,"Alta de productos","","",-1,-1,0,"./pan_pts_altas.php"]);
stm_aix("p13i1","p10i1",[0,"Consulta y modificaci�n<BR>de Productos","","",-1,-1,0,"./pan_pts_con.php"]);
stm_ep();
stm_aix("p7i6","p1i4",[0,"Materias Primas"]);
stm_bpx("p14","p2",[]);
stm_aix("p14i0","p2i5",[0,"Cat�logo de Materia Prima","","",-1,-1,0,"MateriasPrimasCatalogo.php"]);
stm_aix("p14i1","p0i1",[6,1,"#73a8b7"]);
stm_aix("p14i2","p3i3",[0,"Alta de descuentos de<BR>Materias Primas","","",-1,-1,0,"./fac_dmp_altas.php"]);
stm_aix("p14i3","p2i5",[0,"Consultas","","",-1,-1,0,"./fac_dmp_con.php"]);
stm_aix("p14i4","p2i5",[0,"Consulta de Costos Unitarios","","",-1,-1,0,"./fac_costos_con.php"]);
stm_ep();
stm_aix("p7i7","p1i4",[0,"Gastos"]);
stm_bpx("p15","p2",[]);
stm_aix("p15i0","p3i3",[0,"Alta de gastos","","",-1,-1,0,"./fac_gas_altas.php"]);
stm_aix("p15i1","p9i1",[0,"Modificar Gastos","","",-1,-1,0,"./fac_gasto_mod.php"]);
stm_aix("p15i2","p2i5",[0,"Consultas","","",-1,-1,0,"./fac_gastos_con.php"]);
stm_ep();
stm_aix("p7i8","p1i0",[0,"Documentos  "]);
stm_bpx("p16","p2",[]);
stm_aix("p16i0","p3i3",[0,"Consulta de Documentos","","",-1,-1,0,"./doc_doc_con.php"]);
stm_aix("p16i1","p3i3",[0,"Digitalizaci�n de Documentos","","",-1,-1,0,"./doc_doc_scan.php"]);
stm_aix("p16i2","p3i3",[0,"Consulta de Tipos de Documento","","",-1,-1,0,"./doc_cat_doc_con.php"]);
stm_aix("p16i3","p3i3",[0,"Alta de Tipo de Documento","","",-1,-1,0,"./doc_cat_doc_altas.php"]);
stm_ep();
stm_aix("p7i9","p1i0",[0,"Camionetas  "]);
stm_bpx("p17","p2",[]);
stm_aix("p17i0","p3i3",[0,"Alta de Camionetas","","",-1,-1,0,"./doc_cam_altas.php"]);
stm_aix("p17i1","p2i5",[0,"Consulta de Camionetas","","",-1,-1,0,"./doc_cam_con.php"]);
stm_aix("p17i2","p3i3",[0,"Revisiones Vehiculares","","",-1,-1,0,"./doc_cam_rev_cap.php"]);
stm_aix("p17i3","p2i5",[0,"Consulta de Revisiones Vehiculares","","",-1,-1,0,"./doc_cam_rev_con.php"]);
stm_aix("p17i4","p2i5",[0,"Cartas para Certificados de Verificaci�n","","",-1,-1,0,"GenerarCartasCertificadosVerificaciones.php","_self"]);
stm_aix("p17i5","p3i3",[0,"Alta de Tipo de Documento","","",-1,-1,0,"./doc_cat_doc_cam_altas.php"]);
stm_aix("p17i6","p2i5",[0,"Consulta de Tipos de Documento","","",-1,-1,0,"./doc_cat_doc_cam_con.php"]);
stm_ep();
stm_aix("p7i10","p1i0",[0,"Maquinaria"]);
stm_bpx("p18","p2",[]);
stm_aix("p18i0","p3i3",[0,"Alta","","",-1,-1,0,"./fac_maq_alta.php"]);
stm_aix("p18i1","p2i5",[0,"Consulta","","",-1,-1,0,"./fac_maq_con.php"]);
stm_aix("p18i2","p2i5",[0,"Listados","","",-1,-1,0,"./fac_maq_lis.php"]);
stm_aix("p18i3","p17i4",[0,"Orden de Servicio","","",-1,-1,0,"./fac_ord_ser_alta.php"]);
stm_aix("p18i4","p17i4",[0,"Consulta de Ordenes de Servicio","","",-1,-1,0,"./fac_ord_ser_mod.php"]);
stm_ep();
stm_aix("p7i11","p1i0",[0,"Agua y predial"]);
stm_bpx("p19","p2",[]);
stm_aix("p19i0","p3i3",[0,"Cat�logo de agua y predial","","",-1,-1,0,"AguaPredialCatalogo.php"]);
stm_ep();
stm_ep();
stm_aix("p0i3","p0i1",[]);
stm_aix("p0i4","p0i0",[0,"Trabajadores  "]);
stm_bpx("p20","p1",[]);
stm_aix("p20i0","p1i0",[0,"Trabajador"]);
stm_bpx("p21","p2",[]);
stm_aix("p21i0","p3i3",[0,"Alta de trabajador","","",-1,-1,0,"TrabajadoresAlta.php"]);
stm_aix("p21i1","p2i5",[0,"Consulta de trabajadores","","",-1,-1,0,"TrabajadoresConsulta.php"]);
stm_aix("p21i2","p2i5",[0,"Consulta de bajas foleadas de trabajadores","","",-1,-1,0,"TrabajadoresBajasConsulta.php"]);
stm_aix("p21i3","p2i0",[0,"Solicitudes de altas y bajas de I.M.S.S.","","",-1,-1,0,"TrabajadoresSolicitudCompanias.php"]);
stm_ep();
stm_aix("p20i1","p14i1",[]);
stm_aix("p20i2","p1i4",[0,"Lista Negra"]);
stm_bpx("p22","p2",[]);
stm_aix("p22i0","p3i3",[0,"Alta","","",-1,-1,0,"ListaNegraAlta.php"]);
stm_aix("p22i1","p2i5",[0,"Consulta","","",-1,-1,0,"ListaNegraTrabajadores.php"]);
stm_aix("p22i2","p2i5",[0,"Administrar","","",-1,-1,0,"ListaNegraTrabajadoresAdmin.php"]);
stm_aix("p22i3","p14i1",[]);
stm_aix("p22i4","p2i5",[0,"Cat�logo de tipos de baja","","",-1,-1,0,"TiposBajaConsulta.php"]);
stm_ep();
stm_aix("p20i3","p14i1",[]);
stm_aix("p20i4","p1i0",[0,"Aguinaldos"]);
stm_bpx("p23","p2",[]);
stm_aix("p23i0","p2i5",[0,"Consultas (aguinaldos)","","",-1,-1,0,"TrabajadoresConsultaAdmin.php"]);
stm_aix("p23i1","p2i0",[0,"Aguinaldos","","",-1,-1,0,"./fac_tra_agu.php"]);
stm_aix("p23i2","p2i0",[0,"Etiquetas","","",-1,-1,0,"./fac_imp_eti.php"]);
stm_ep();
stm_aix("p20i5","p14i1",[]);
stm_aix("p20i6","p1i0",[0,"IMSS"]);
stm_bpx("p24","p2",[]);
stm_aix("p24i0","p2i0",[0,"Impresi�n de Carta de Alta/Baja del IMSS","","",-1,-1,0,"CartaMovimientosIMSS.php"]);
stm_aix("p24i1","p2i0",[0,"Impresi�n de Aviso de Atraso de Alta/Baja del IMSS","","",-1,-1,0,"./fac_imp_avi.php"]);
stm_aix("p24i2","p3i3",[0,"Cambio de Estado de Trabajador","","",-1,-1,0,"./fac_act_est.php"]);
stm_aix("p24i3","p2i0",[0,"Carta alta/baja IMSS","","",-1,-1,0,"./fac_carta_imss.php"]);
stm_aix("p24i4","p14i1",[]);
stm_aix("p24i5","p2i0",[0,"Escanear Documentos","","",-1,-1,0,"fac_doc_emp_alta.php"]);
stm_aix("p24i6","p17i4",[0,"Consultar Documentos","","",-1,-1,0,"fac_doc_emp_con.php"]);
stm_ep();
stm_aix("p20i7","p14i1",[]);
stm_aix("p20i8","p1i0",[0,"Nomina  "]);
stm_bpx("p25","p2",[]);
stm_aix("p25i0","p2i0",[0,"Registro de N�mina Recibida","","",-1,-1,0,"./fac_nom_cap.php"]);
stm_aix("p25i1","p2i5",[0,"Reportes de N�mina","","",-1,-1,0,"./fac_nom_con.php"]);
stm_aix("p25i2","p2i0",[0,"Formato para N�mina","","",-1,-1,0,"./fac_tra_baj_fic.php"]);
stm_ep();
stm_aix("p20i9","p14i1",[]);
stm_aix("p20i10","p1i0",[0,"Infonavit"]);
stm_bpx("p26","p2",[]);
stm_aix("p26i0","p2i0",[0,"Pago de Infonavit","","",-1,-1,0,"./ban_inf_pag.php"]);
stm_aix("p26i1","p2i0",[0,"Impresi�n de recibos","","",-1,-1,0,"InfonavitImprimirRecibos.php"]);
stm_aix("p26i2","p2i5",[0,"Consulta de recibos","","",-1,-1,0,"./fac_inf_con.php"]);
stm_aix("p26i3","p6i0",[0,"Pagos pendientes de Infonavit","","",-1,-1,0,"./fac_inf_pen.php"]);
stm_aix("p26i4","p2i5",[0,"Consulta de pagos pendientes","","",-1,-1,0,"./fac_inf_pen_con.php"]);
stm_aix("p26i5","p2i0",[0,"Borrar pagos pendientes","","",-1,-1,0,"./fac_inf_pen_mod.php","mainFrame","","","delete.gif","delete.gif"]);
stm_ep();
stm_aix("p20i11","p14i1",[]);
stm_aix("p20i12","p1i0",[0,"Reportes"]);
stm_bpx("p27","p2",[]);
stm_aix("p27i0","p2i5",[0,"Bajas de trabajadores","","",-1,-1,0,"TrabajadoresBajasReporte.php"]);
stm_ep();
stm_aix("p20i13","p14i1",[]);
stm_aix("p20i14","p1i0",[0,"Cat�logos"]);
stm_bpx("p28","p2",[]);
stm_aix("p28i0","p2i0",[0,"Tipos de baja de trabajador","","",-1,-1,0,"TiposBajaTrabajadorCatalogo.php"]);
stm_ep();
stm_ep();
stm_aix("p0i5","p0i1",[]);
stm_aix("p0i6","p0i0",[0,"Inventarios  "]);
stm_bpx("p29","p2",[1,4]);
stm_aix("p29i0","p2i5",[0,"Auxiliar de Inventarios","","",-1,-1,0,"AuxiliarInventario.php"]);
stm_aix("p29i1","p2i5",[0,"Existencias de Gas","","",-1,-1,0,"./fac_gas_exi.php"]);
stm_aix("p29i2","p2i5",[0,"Consulta de Pedidos","","",-1,-1,0,"PedidosConsulta.php"]);
stm_ep();
stm_aix("p0i7","p0i1",[]);
stm_aix("p0i8","p0i0",[0,"Contadores  "]);
stm_bpx("p30","p29",[]);
stm_aix("p30i0","p1i0",[0,"Facturas","","",-1,-1,0,"","","","","bullet2.gif","bullet2.gif",16,16,0,"","",0,0]);
stm_aix("p30i1","p14i1",[]);
stm_aix("p30i2","p3i3",[0,"Archivo de facturas","","",-1,-1,0,"./fac_conta_file.php"]);
stm_aix("p30i3","p3i3",[0,"Archivo de Facturas Pendientes","","",-1,-1,0,"./fac_fac_pen.php"]);
stm_aix("p30i4","p2i5",[0,"Facturas de todo el mes","","",-1,-1,0,"./fac_conta_con.php"]);
stm_aix("p30i5","p14i1",[]);
stm_aix("p30i6","p30i0",[0,"Cheques"]);
stm_aix("p30i7","p3i3",[0,"Archivo de cheques","","",-1,-1,0,"./ban_conta_file.php"]);
stm_ep();
stm_aix("p0i9","p0i1",[]);
stm_aix("p0i10","p0i0",[0,"Cartas  "]);
stm_bpx("p31","p1",[1,4,0,0,0,3,16,0,80]);
stm_aix("p31i0","p2i0",[0,"Escribir Carta","","",-1,-1,0,"./ban_gen_car.php","mainFrame","","","insert2.gif","insert2.gif",-1,-1]);
stm_aix("p31i1","p31i0",[0,"Escribir Memorandum","","",-1,-1,0,"./ban_gen_mem.php"]);
stm_ep();
stm_aix("p0i11","p0i1",[]);
stm_aix("p0i12","p0i0",[0,"Hojas  "]);
stm_bpx("p32","p31",[1,4,0,0,0,3,0]);
stm_aix("p32i0","p2i0",[0,"Impresi�n de Hojas<BR>de Panader�as","","",-1,-1,0,"./pan_imp_hoj.php","_self","","","","",0,0]);
stm_ep();
stm_ep();
stm_em();

with(st_ms[st_cm-1])
{
	mcff="mainFrame";
	mcfn=1;
	mcfd=0;
	mcfx=0;
	mcfy=0;
}
