use zNwk;
GO
drop table if exists eTab;
GO
drop table if exists rTab;
GO
create table rTab(Id int auto_increment primary key,
		  LQI int not null,
		  Volt char(8) not null,
		  Temp char(8) not null,
		  time timestamp not null
		  );
GO
create table eTab(Id int auto_increment primary key,
		  LQI int not null,
	          Volt char(8) not null,
		  Red char(8) not null,
		  Green char(8) not null,
 		  Blue char(8) not null,
	          time timestamp not null
		);
GO

