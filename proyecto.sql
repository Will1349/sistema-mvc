/*
Navicat MySQL Data Transfer

Source Server         : my conecion
Source Server Version : 50634
Source Host           : localhost:3306
Source Database       : proyecto

Target Server Type    : MYSQL
Target Server Version : 50634
File Encoding         : 65001

Date: 2021-02-24 19:14:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_asignaciontutor
-- ----------------------------
DROP TABLE IF EXISTS `tbl_asignaciontutor`;
CREATE TABLE `tbl_asignaciontutor` (
  `id_asignacion_tutor` int(11) NOT NULL AUTO_INCREMENT,
  `id_docente` int(11) NOT NULL,
  `id_Tema` int(11) NOT NULL,
  PRIMARY KEY (`id_asignacion_tutor`),
  KEY `AsignacionDocente` (`id_docente`),
  KEY `TemaAsignacion` (`id_Tema`),
  CONSTRAINT `AsignacionDocente` FOREIGN KEY (`id_docente`) REFERENCES `tbl_docente` (`id_docente`),
  CONSTRAINT `TemaAsignacion` FOREIGN KEY (`id_Tema`) REFERENCES `tbl_tema` (`id_tema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_capitulo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_capitulo`;
CREATE TABLE `tbl_capitulo` (
  `id_capitulo` int(11) NOT NULL AUTO_INCREMENT,
  `cap_capitulo` varchar(20) DEFAULT NULL,
  `cap_estado` varchar(30) DEFAULT NULL,
  `cap_fecha` varchar(255) DEFAULT NULL,
  `id_Tema` int(11) NOT NULL,
  PRIMARY KEY (`id_capitulo`),
  KEY `CapituloTema` (`id_Tema`),
  CONSTRAINT `CapituloTema` FOREIGN KEY (`id_Tema`) REFERENCES `tbl_tema` (`id_tema`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_carrera
-- ----------------------------
DROP TABLE IF EXISTS `tbl_carrera`;
CREATE TABLE `tbl_carrera` (
  `id_carrera` int(11) NOT NULL AUTO_INCREMENT,
  `car_nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_docente
-- ----------------------------
DROP TABLE IF EXISTS `tbl_docente`;
CREATE TABLE `tbl_docente` (
  `id_docente` int(11) NOT NULL AUTO_INCREMENT,
  `doc_nombre` varchar(20) DEFAULT NULL,
  `doc_apellido` varchar(20) DEFAULT NULL,
  `doc_cedula` varchar(10) DEFAULT NULL,
  `doc_correo` varchar(100) DEFAULT NULL,
  `doc_celular` varchar(10) DEFAULT NULL,
  `doc_ntemas` int(11) DEFAULT NULL,
  `id_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_docente`),
  KEY `UsuarioDocente` (`id_Usuario`),
  CONSTRAINT `UsuarioDocente` FOREIGN KEY (`id_Usuario`) REFERENCES `tbl_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_estado
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estado`;
CREATE TABLE `tbl_estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `est_nombre` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_estudiantes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estudiantes`;
CREATE TABLE `tbl_estudiantes` (
  `id_estudiante` int(11) NOT NULL AUTO_INCREMENT,
  `est_nombre` varchar(20) DEFAULT NULL,
  `est_apellido` varchar(20) DEFAULT NULL,
  `est_cedula` varchar(10) DEFAULT NULL,
  `est_correo` varchar(100) DEFAULT NULL,
  `est_celular` varchar(10) DEFAULT NULL,
  `id_Carrera` int(11) NOT NULL,
  `id_Tema` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_estudiante`),
  KEY `CarreraEstudiante` (`id_Carrera`),
  KEY `TemaEstudiante` (`id_Tema`),
  KEY `UsuarioEstudiante` (`id_Usuario`),
  CONSTRAINT `CarreraEstudiante` FOREIGN KEY (`id_Carrera`) REFERENCES `tbl_carrera` (`id_carrera`),
  CONSTRAINT `TemaEstudiante` FOREIGN KEY (`id_Tema`) REFERENCES `tbl_tema` (`id_tema`),
  CONSTRAINT `UsuarioEstudiante` FOREIGN KEY (`id_Usuario`) REFERENCES `tbl_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_rol
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rol`;
CREATE TABLE `tbl_rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_tema
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tema`;
CREATE TABLE `tbl_tema` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `tem_nombre` varchar(100) DEFAULT NULL,
  `tem_estado` varchar(20) DEFAULT NULL,
  `id_Estado` int(11) NOT NULL,
  PRIMARY KEY (`id_tema`),
  KEY `TemaEstado` (`id_Estado`),
  CONSTRAINT `TemaEstado` FOREIGN KEY (`id_Estado`) REFERENCES `tbl_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tbl_usuario`;
CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usu_usuario` varchar(20) DEFAULT NULL,
  `usu_pass` varchar(10) DEFAULT NULL,
  `id_Rol` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `RolUsuario` (`id_Rol`),
  CONSTRAINT `RolUsuario` FOREIGN KEY (`id_Rol`) REFERENCES `tbl_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
