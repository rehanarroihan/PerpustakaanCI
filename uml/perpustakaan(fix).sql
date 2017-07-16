/*==============================================================*/
/* DBMS name:      Sybase SQL Anywhere 12                       */
/* Created on:     30/05/2017 11:52:18 PM                       */
/*==============================================================*/

/*==============================================================*/
/* Table: ADMIN                                                 */
/*==============================================================*/
create table ADMIN 
(
   ID_ADMIN             integer                        not null		AUTO_INCREMENT,
   FULLNAME             varchar(128)                   null,
   USERNAME             varchar(128)                   null,
   PASSWORD             long varchar                   null,
   LAST_LOGIN           varchar(40)                    null,
   ROLE                 varchar(8)                     null,
   PHOTO                long varchar                   null,
   constraint PK_ADMIN primary key (ID_ADMIN)
);

/*==============================================================*/
/* Index: ADMIN_PK                                              */
/*==============================================================*/
create unique index ADMIN_PK on ADMIN (
ID_ADMIN ASC
);

/*==============================================================*/
/* Table: ANGGOTA                                               */
/*==============================================================*/
create table ANGGOTA 
(
   ID_ANGGOTA           integer                        not null			AUTO_INCREMENT,
   ID_ADMIN             integer                        null,
   FULL_NAME            varchar(128)                   null,
   TMP_LAHIR            varchar(90)                    null,
   TGL_LAHIR            date                           null,
   ADDRESS              long varchar                   null,
   GENDER               char(1)                        null,
   TELP                 varchar(20)                    null,
   FOTO                 long varchar                   null,
   constraint PK_ANGGOTA primary key (ID_ANGGOTA)
);

/*==============================================================*/
/* Index: ANGGOTA_PK                                            */
/*==============================================================*/
create unique index ANGGOTA_PK on ANGGOTA (
ID_ANGGOTA ASC
);

/*==============================================================*/
/* Index: MAKE_FK                                               */
/*==============================================================*/
create index MAKE_FK on ANGGOTA (
ID_ADMIN ASC
);

/*==============================================================*/
/* Table: BUKU                                                  */
/*==============================================================*/
create table BUKU 
(
   ID_BUKU              integer                        not null			AUTO_INCREMENT,
   ID_ADMIN             integer                        null,
   TITLE                varchar(150)                   null,
   AUTHOR               varchar(128)                   null,
   PUBLISHER            varchar(128)                   null,
   YEAR                 char(4)                        null,
   QTY                  integer                        null,
   DIPINJAM             integer                        null,
   constraint PK_BUKU primary key (ID_BUKU)
);

/*==============================================================*/
/* Index: BUKU_PK                                               */
/*==============================================================*/
create unique index BUKU_PK on BUKU (
ID_BUKU ASC
);

/*==============================================================*/
/* Index: CREATE_FK                                             */
/*==============================================================*/
create index CREATE_FK on BUKU (
ID_ADMIN ASC
);

/*==============================================================*/
/* Table: DETAIL_PINJAM                                         */
/*==============================================================*/
create table DETAIL_PINJAM 
(
   ID_DIPINJAM          integer                        not null				AUTO_INCREMENT,
   ID_PINJAM            integer                        null,
   ID_BUKU              integer                        null,
   TGL_KEMBALI          date                           null,
   DENDA                integer                        null,
   STATUS               varchar(20)                    null,
   constraint PK_DETAIL_PINJAM primary key (ID_DIPINJAM)
);

/*==============================================================*/
/* Index: DETAIL_PINJAM_PK                                      */
/*==============================================================*/
create unique index DETAIL_PINJAM_PK on DETAIL_PINJAM (
ID_DIPINJAM ASC
);

/*==============================================================*/
/* Index: MEMILIKI_FK                                           */
/*==============================================================*/
create index MEMILIKI_FK on DETAIL_PINJAM (
ID_PINJAM ASC
);

/*==============================================================*/
/* Index: MENGAMBIL_FK                                          */
/*==============================================================*/
create index MENGAMBIL_FK on DETAIL_PINJAM (
ID_BUKU ASC
);

/*==============================================================*/
/* Table: PEMINJAMAN                                            */
/*==============================================================*/
create table PEMINJAMAN 
(
   ID_PINJAM            integer                        not null			AUTO_INCREMENT,
   ID_ANGGOTA           integer                        null,
   ID_ADMIN             integer                        null,
   TGL_PINJAM           date                           null,
   constraint PK_PEMINJAMAN primary key (ID_PINJAM)
);

/*==============================================================*/
/* Index: PEMINJAMAN_PK                                         */
/*==============================================================*/
create unique index PEMINJAMAN_PK on PEMINJAMAN (
ID_PINJAM ASC
);

/*==============================================================*/
/* Index: MELAKUKAN_FK                                          */
/*==============================================================*/
create index MELAKUKAN_FK on PEMINJAMAN (
ID_ANGGOTA ASC
);

/*==============================================================*/
/* Index: MELAYANI_FK                                           */
/*==============================================================*/
create index MELAYANI_FK on PEMINJAMAN (
ID_ADMIN ASC
);

/*==============================================================*/
/* Table: PERPUS                                                */
/*==============================================================*/
create table PERPUS 
(
   ID_PERPUS            integer                        not null				AUTO_INCREMENT,
   NAMA_P               varchar(128)                   null,
   ALAMAT_P             long varchar                   null,
   ABOUT                long varchar                   null,
   constraint PK_PERPUS primary key (ID_PERPUS)
);

/*==============================================================*/
/* Index: PERPUS_PK                                             */
/*==============================================================*/
create unique index PERPUS_PK on PERPUS (
ID_PERPUS ASC
);

alter table ANGGOTA
   add constraint FK_ANGGOTA_MAKE_ADMIN foreign key (ID_ADMIN)
      references ADMIN (ID_ADMIN)
      on update restrict
      on delete restrict;

alter table BUKU
   add constraint FK_BUKU_CREATE_ADMIN foreign key (ID_ADMIN)
      references ADMIN (ID_ADMIN)
      on update restrict
      on delete restrict;

alter table DETAIL_PINJAM
   add constraint FK_DETAIL_P_MEMILIKI_PEMINJAM foreign key (ID_PINJAM)
      references PEMINJAMAN (ID_PINJAM)
      on update restrict
      on delete restrict;

alter table DETAIL_PINJAM
   add constraint FK_DETAIL_P_MENGAMBIL_BUKU foreign key (ID_BUKU)
      references BUKU (ID_BUKU)
      on update restrict
      on delete restrict;

alter table PEMINJAMAN
   add constraint FK_PEMINJAM_MELAKUKAN_ANGGOTA foreign key (ID_ANGGOTA)
      references ANGGOTA (ID_ANGGOTA)
      on update restrict
      on delete restrict;

alter table PEMINJAMAN
   add constraint FK_PEMINJAM_MELAYANI_ADMIN foreign key (ID_ADMIN)
      references ADMIN (ID_ADMIN)
      on update restrict
      on delete restrict;

