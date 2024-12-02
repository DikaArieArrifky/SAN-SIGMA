USE [master]
GO
/****** Object:  Database [san_sigma1]    Script Date: 02/12/2024 14.17.23 ******/
CREATE DATABASE [san_sigma1]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'san_sigma1', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\san_sigma1.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'san_sigma1_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\san_sigma1_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO
ALTER DATABASE [san_sigma1] SET COMPATIBILITY_LEVEL = 140
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [san_sigma1].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [san_sigma1] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [san_sigma1] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [san_sigma1] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [san_sigma1] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [san_sigma1] SET ARITHABORT OFF 
GO
ALTER DATABASE [san_sigma1] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [san_sigma1] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [san_sigma1] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [san_sigma1] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [san_sigma1] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [san_sigma1] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [san_sigma1] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [san_sigma1] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [san_sigma1] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [san_sigma1] SET  ENABLE_BROKER 
GO
ALTER DATABASE [san_sigma1] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [san_sigma1] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [san_sigma1] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [san_sigma1] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [san_sigma1] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [san_sigma1] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [san_sigma1] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [san_sigma1] SET RECOVERY FULL 
GO
ALTER DATABASE [san_sigma1] SET  MULTI_USER 
GO
ALTER DATABASE [san_sigma1] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [san_sigma1] SET DB_CHAINING OFF 
GO
ALTER DATABASE [san_sigma1] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [san_sigma1] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [san_sigma1] SET DELAYED_DURABILITY = DISABLED 
GO
EXEC sys.sp_db_vardecimal_storage_format N'san_sigma1', N'ON'
GO
ALTER DATABASE [san_sigma1] SET QUERY_STORE = OFF
GO
USE [san_sigma1]
GO
/****** Object:  Table [dbo].[admins]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[admins](
	[id] [int] NOT NULL,
	[user_id] [int] NOT NULL,
	[name] [nvarchar](100) NOT NULL,
	[gender] [nvarchar](10) NOT NULL,
	[phone_number] [nvarchar](20) NULL,
	[photo] [nvarchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[dosens]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dosens](
	[id] [int] NOT NULL,
	[user_id] [int] NOT NULL,
	[name] [nvarchar](255) NOT NULL,
	[gender] [nvarchar](10) NOT NULL,
	[phone_number] [nvarchar](20) NULL,
	[nip] [nvarchar](20) NULL,
	[status] [nvarchar](20) NULL,
	[photo] [nvarchar](max) NULL,
	[Alamat] [nvarchar](255) NULL,
	[Kota] [nvarchar](50) NULL,
	[Provinsi] [nvarchar](50) NULL,
	[agama] [nvarchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[mahasiswas]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[mahasiswas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[prodi_id] [int] NOT NULL,
	[user_id] [int] NOT NULL,
	[name] [nvarchar](100) NOT NULL,
	[gender] [nvarchar](1) NOT NULL,
	[phone_number] [nvarchar](20) NULL,
	[nim] [nvarchar](50) NOT NULL,
	[status] [nvarchar](50) NULL,
	[college_year] [int] NOT NULL,
	[score] [int] NULL,
	[photo] [nvarchar](max) NULL,
	[Alamat] [nvarchar](max) NULL,
	[Kota] [nvarchar](50) NULL,
	[Provinsi] [nvarchar](50) NULL,
	[agama] [nvarchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[penghargaans]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[penghargaans](
	[id] [int] NOT NULL,
	[mahasiswa_id] [int] NOT NULL,
	[judul] [nvarchar](255) NOT NULL,
	[tempat] [nvarchar](50) NULL,
	[url] [nvarchar](max) NULL,
	[tanggal_mulai] [date] NULL,
	[tanggal_akhir] [date] NULL,
	[jumlah_instansi] [int] NULL,
	[jumlah_peserta] [int] NULL,
	[no_surat_tugas] [nvarchar](50) NULL,
	[tanggal_surat] [date] NULL,
	[file_surat_tugas] [nvarchar](max) NULL,
	[file_sertifikat] [nvarchar](max) NULL,
	[file_poster] [nvarchar](max) NULL,
	[file_photo_kegiatan] [nvarchar](max) NULL,
	[score] [int] NULL,
	[tingkat_id] [int] NOT NULL,
	[peringkat_id] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[peringkats]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[peringkats](
	[id] [int] NOT NULL,
	[nama] [nvarchar](50) NOT NULL,
	[multiple] [float] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[prodis]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[prodis](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama] [nvarchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tingkatans]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tingkatans](
	[id] [int] NOT NULL,
	[nama] [nvarchar](50) NOT NULL,
	[point] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](50) NOT NULL,
	[username] [nvarchar](50) NOT NULL,
	[password] [nvarchar](50) NOT NULL,
	[role] [nvarchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[verifikasis]    Script Date: 02/12/2024 14.17.24 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[verifikasis](
	[id] [int] NOT NULL,
	[mahasiswa_id] [int] NOT NULL,
	[dosen_id] [int] NOT NULL,
	[admin_id] [int] NOT NULL,
	[penghargaan_id] [int] NULL,
	[verif_admin] [nvarchar](50) NULL,
	[pesan_admin] [nvarchar](max) NULL,
	[verif_pembimbing] [nvarchar](50) NULL,
	[pesan_pembimbing] [nvarchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
INSERT [dbo].[admins] ([id], [user_id], [name], [gender], [phone_number], [photo]) VALUES (1, 1, N'Andi Wijaya', N'L', N'081234567890', N'andi.jpg')
INSERT [dbo].[admins] ([id], [user_id], [name], [gender], [phone_number], [photo]) VALUES (2, 2, N'Budi Santoso', N'L', N'081234567891', N'budi.jpg')
INSERT [dbo].[admins] ([id], [user_id], [name], [gender], [phone_number], [photo]) VALUES (3, 3, N'Citra Dewi', N'P', N'081234567892', N'citra.jpg')
INSERT [dbo].[admins] ([id], [user_id], [name], [gender], [phone_number], [photo]) VALUES (4, 4, N'Dedi Saputra', N'L', N'081234567893', N'dedi.jpg')
INSERT [dbo].[admins] ([id], [user_id], [name], [gender], [phone_number], [photo]) VALUES (5, 5, N'Eka Prasetyo', N'L', N'081234567894', N'eka.jpg')
GO
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (1, 36, N'Andi Wijaya', N'L', N'081234567890', N'12345678', N'aktif', N'andi.jpg', N'Jl. Merdeka No. 1', N'Malang', N'Jawa Timur', N'Islam')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (2, 37, N'Budi Santoso', N'L', N'081234567891', N'23456789', N'aktif', N'budi.jpg', N'Jl. Pahlawan No. 2', N'Surabaya', N'Jawa Timur', N'Kristen')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (3, 38, N'Citra Dewi', N'P', N'081234567892', N'34567890', N'ga aktif', N'citra.jpg', N'Jl. Bunga No. 3', N'Bandung', N'Jawa Barat', N'Hindu')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (4, 39, N'Dedi Saputra', N'L', N'081234567893', N'45678901', N'aktif', N'dedi.jpg', N'Jl. Raya No. 4', N'Jakarta', N'DKI Jakarta', N'Islam')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (5, 40, N'Eka Prasetyo', N'L', N'081234567894', N'56789012', N'aktif', N'eka.jpg', N'Jl. Merdeka No. 5', N'Malang', N'Jawa Timur', N'Buddha')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (6, 41, N'Fitria Sari', N'P', N'081234567895', N'67890123', N'ga aktif', N'fitria.jpg', N'Jl. Raya No. 6', N'Yogyakarta', N'DI Yogyakarta', N'Kristen')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (7, 42, N'Gilang Ramadhan', N'L', N'081234567896', N'78901234', N'aktif', N'gilang.jpg', N'Jl. Pahlawan No. 7', N'Semarang', N'Jawa Tengah', N'Islam')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (8, 43, N'Hana Permata', N'P', N'081234567897', N'89012345', N'aktif', N'hana.jpg', N'Jl. Kemenangan No. 8', N'Bandung', N'Jawa Barat', N'Islam')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (9, 44, N'Irfan Hakim', N'L', N'081234567898', N'90123456', N'ga aktif', N'irfan.jpg', N'Jl. Damai No. 9', N'Surabaya', N'Jawa Timur', N'Protestan')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (10, 45, N'Joko Susilo', N'L', N'081234567899', N'01234567', N'aktif', N'joko.jpg', N'Jl. Raya No. 10', N'Malang', N'Jawa Timur', N'Islam')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (11, 46, N'Karin Putri', N'P', N'081234567900', N'12345098', N'aktif', N'karin.jpg', N'Jl. Merdeka No. 11', N'Yogyakarta', N'DI Yogyakarta', N'Hindu')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (12, 47, N'Lutfi Mahendra', N'L', N'081234567901', N'23456109', N'ga aktif', N'lutfi.jpg', N'Jl. Kemenangan No. 12', N'Semarang', N'Jawa Tengah', N'Islam')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (13, 48, N'Maya Anjani', N'P', N'081234567902', N'34567210', N'aktif', N'maya.jpg', N'Jl. Raya No. 13', N'Jakarta', N'DKI Jakarta', N'Islam')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (14, 49, N'Nanda Pratama', N'L', N'081234567903', N'45678321', N'ga aktif', N'nanda.jpg', N'Jl. Pahlawan No. 14', N'Surabaya', N'Jawa Timur', N'Kristen')
INSERT [dbo].[dosens] ([id], [user_id], [name], [gender], [phone_number], [nip], [status], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (15, 50, N'Oki Wibowo', N'L', N'081234567904', N'56789432', N'aktif', N'oki.jpg', N'Jl. Damai No. 15', N'Malang', N'Jawa Timur', N'Buddha')
GO
SET IDENTITY_INSERT [dbo].[mahasiswas] ON 

INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (1, 1, 21, N'Andi Pratama', N'L', N'081234567910', N'123456789', N'aktif', 2022, 2500, N'andi.jpg', N'Jl. Raya No. 1', N'Malang', N'Jawa Timur', N'Islam')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (2, 2, 22, N'Budi Santoso', N'L', N'081234567911', N'223456789', N'aktif', 2021, 2300, N'budi.jpg', N'Jl. Merdeka No. 2', N'Surabaya', N'Jawa Timur', N'Kristen')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (3, 1, 23, N'Citra Dewi', N'P', N'081234567912', N'323456789', N'aktif', 2020, 2200, N'citra.jpg', N'Jl. Pahlawan No. 3', N'Bandung', N'Jawa Barat', N'Hindu')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (4, 2, 24, N'Dedi Saputra', N'L', N'081234567913', N'423456789', N'aktif', 2023, 2800, N'dedi.jpg', N'Jl. Raya No. 4', N'Jakarta', N'DKI Jakarta', N'Islam')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (5, 1, 25, N'Eka Prasetyo', N'L', N'081234567914', N'523456789', N'aktif', 2022, 2400, N'eka.jpg', N'Jl. Merdeka No. 5', N'Malang', N'Jawa Timur', N'Buddha')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (6, 2, 26, N'Fitria Sari', N'P', N'081234567915', N'623456789', N'aktif', 2020, 2100, N'fitria.jpg', N'Jl. Pahlawan No. 6', N'Yogyakarta', N'DI Yogyakarta', N'Kristen')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (7, 1, 27, N'Gilang Ramadhan', N'L', N'081234567916', N'723456789', N'aktif', 2021, 2700, N'gilang.jpg', N'Jl. Raya No. 7', N'Semarang', N'Jawa Tengah', N'Islam')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (8, 2, 28, N'Hana Permata', N'P', N'081234567917', N'823456789', N'aktif', 2023, 2900, N'hana.jpg', N'Jl. Kemenangan No. 8', N'Bandung', N'Jawa Barat', N'Islam')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (9, 1, 29, N'Irfan Hakim', N'L', N'081234567918', N'923456789', N'aktif', 2020, 2000, N'irfan.jpg', N'Jl. Damai No. 9', N'Surabaya', N'Jawa Timur', N'Protestan')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (10, 2, 30, N'Joko Susilo', N'L', N'081234567919', N'103456789', N'aktif', 2022, 2600, N'joko.jpg', N'Jl. Raya No. 10', N'Malang', N'Jawa Timur', N'Islam')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (11, 1, 31, N'Karin Putri', N'P', N'081234567920', N'113456789', N'aktif', 2021, 2500, N'karin.jpg', N'Jl. Merdeka No. 11', N'Yogyakarta', N'DI Yogyakarta', N'Hindu')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (12, 2, 32, N'Lutfi Mahendra', N'L', N'081234567921', N'123456780', N'aktif', 2020, 2200, N'lutfi.jpg', N'Jl. Kemenangan No. 12', N'Semarang', N'Jawa Tengah', N'Islam')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (13, 1, 33, N'Maya Anjani', N'P', N'081234567922', N'133456789', N'aktif', 2023, 3000, N'maya.jpg', N'Jl. Raya No. 13', N'Jakarta', N'DKI Jakarta', N'Islam')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (14, 2, 34, N'Nanda Pratama', N'L', N'081234567923', N'143456789', N'aktif', 2021, 2400, N'nanda.jpg', N'Jl. Pahlawan No. 14', N'Surabaya', N'Jawa Timur', N'Kristen')
INSERT [dbo].[mahasiswas] ([id], [prodi_id], [user_id], [name], [gender], [phone_number], [nim], [status], [college_year], [score], [photo], [Alamat], [Kota], [Provinsi], [agama]) VALUES (15, 1, 35, N'Oki Wibowo', N'L', N'081234567924', N'153456789', N'aktif', 2022, 2700, N'oki.jpg', N'Jl. Damai No. 15', N'Malang', N'Jawa Timur', N'Buddha')
SET IDENTITY_INSERT [dbo].[mahasiswas] OFF
GO
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (1, 2, N'Juara Basket', N'Surabaya', N'http://example.com/basket', CAST(N'2023-05-01' AS Date), CAST(N'2023-05-03' AS Date), 3, 20, N'ST001', CAST(N'2023-04-28' AS Date), N'surat_basket.pdf', N'sertifikat_basket.pdf', N'poster_basket.jpg', N'photo_basket.jpg', 6400, 2, 1)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (2, 1, N'Juara Futsal', N'Malang', N'http://example.com/futsal', CAST(N'2023-06-01' AS Date), CAST(N'2023-06-03' AS Date), 4, 30, N'ST002', CAST(N'2023-05-29' AS Date), N'surat_futsal.pdf', N'sertifikat_futsal.pdf', N'poster_futsal.jpg', N'photo_futsal.jpg', 5180, 3, 2)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (3, 2, N'UI/UX Design Competition', N'Jakarta', N'http://example.com/uiux', CAST(N'2023-07-10' AS Date), CAST(N'2023-07-12' AS Date), 2, 50, N'ST003', CAST(N'2023-07-05' AS Date), N'surat_uiux.pdf', N'sertifikat_uiux.pdf', N'poster_uiux.jpg', N'photo_uiux.jpg', 4730, 1, 3)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (4, 1, N'Hackathon Nasional', N'Yogyakarta', N'http://example.com/hackathon', CAST(N'2023-08-05' AS Date), CAST(N'2023-08-07' AS Date), 5, 100, N'ST004', CAST(N'2023-08-02' AS Date), N'surat_hackathon.pdf', N'sertifikat_hackathon.pdf', N'poster_hackathon.jpg', N'photo_hackathon.jpg', 5350, 4, 1)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (5, 1, N'Lomba Karya Tulis Ilmiah', N'Bandung', N'http://example.com/karya_tulis', CAST(N'2023-09-01' AS Date), CAST(N'2023-09-03' AS Date), 6, 15, N'ST005', CAST(N'2023-08-30' AS Date), N'surat_karya_tulis.pdf', N'sertifikat_karya_tulis.pdf', N'poster_karya_tulis.jpg', N'photo_karya_tulis.jpg', 4140, 2, 5)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (6, 3, N'Festival Seni Budaya', N'Surabaya', N'http://example.com/seni_budaya', CAST(N'2023-10-01' AS Date), CAST(N'2023-10-05' AS Date), 4, 40, N'ST006', CAST(N'2023-09-28' AS Date), N'surat_seni_budaya.pdf', N'sertifikat_seni_budaya.pdf', N'poster_seni_budaya.jpg', N'photo_seni_budaya.jpg', 3760, 3, 4)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (7, 3, N'Lomba Desain Grafis', N'Jakarta', N'http://example.com/desain_grafis', CAST(N'2023-11-01' AS Date), CAST(N'2023-11-03' AS Date), 2, 60, N'ST007', CAST(N'2023-10-28' AS Date), N'surat_desain_grafis.pdf', N'sertifikat_desain_grafis.pdf', N'poster_desain_grafis.jpg', N'photo_desain_grafis.jpg', 2600, 4, 2)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (8, 3, N'Kompetisi Robotik', N'Bandung', N'http://example.com/robotik', CAST(N'2023-12-10' AS Date), CAST(N'2023-12-12' AS Date), 3, 25, N'ST008', CAST(N'2023-12-07' AS Date), N'surat_robotik.pdf', N'sertifikat_robotik.pdf', N'poster_robotik.jpg', N'photo_robotik.jpg', 6600, 1, 7)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (9, 1, N'Lomba Presentasi Ilmiah', N'Yogyakarta', N'http://example.com/presentasi', CAST(N'2023-11-15' AS Date), CAST(N'2023-11-17' AS Date), 5, 35, N'ST009', CAST(N'2023-11-12' AS Date), N'surat_presentasi.pdf', N'sertifikat_presentasi.pdf', N'poster_presentasi.jpg', N'photo_presentasi.jpg', 5450, 2, 6)
INSERT [dbo].[penghargaans] ([id], [mahasiswa_id], [judul], [tempat], [url], [tanggal_mulai], [tanggal_akhir], [jumlah_instansi], [jumlah_peserta], [no_surat_tugas], [tanggal_surat], [file_surat_tugas], [file_sertifikat], [file_poster], [file_photo_kegiatan], [score], [tingkat_id], [peringkat_id]) VALUES (10, 2, N'Seminar Nasional', N'Malang', N'http://example.com/seminar', CAST(N'2023-10-20' AS Date), CAST(N'2023-10-22' AS Date), 4, 80, N'ST010', CAST(N'2023-10-17' AS Date), N'surat_seminar.pdf', N'sertifikat_seminar.pdf', N'poster_seminar.jpg', N'photo_seminar.jpg', 4490, 3, 1)
GO
INSERT [dbo].[peringkats] ([id], [nama], [multiple]) VALUES (1, N'Juara 1/sederajat', 2)
INSERT [dbo].[peringkats] ([id], [nama], [multiple]) VALUES (2, N'Juara 2/sederajat', 1.8)
INSERT [dbo].[peringkats] ([id], [nama], [multiple]) VALUES (3, N'Juara 3/sederajat', 1.6)
INSERT [dbo].[peringkats] ([id], [nama], [multiple]) VALUES (4, N'Harapan 1/sederajat', 1.5)
INSERT [dbo].[peringkats] ([id], [nama], [multiple]) VALUES (5, N'Harapan 2/sederajat', 1.4)
INSERT [dbo].[peringkats] ([id], [nama], [multiple]) VALUES (6, N'Harapan 3/sederajat', 1.3)
INSERT [dbo].[peringkats] ([id], [nama], [multiple]) VALUES (7, N'Lainnya', 1)
GO
SET IDENTITY_INSERT [dbo].[prodis] ON 

INSERT [dbo].[prodis] ([id], [nama]) VALUES (1, N'D-IV Teknik Informatika')
INSERT [dbo].[prodis] ([id], [nama]) VALUES (2, N'D-IV Sistem Informasi Bisnis')
INSERT [dbo].[prodis] ([id], [nama]) VALUES (3, N'D-II PPRS')
INSERT [dbo].[prodis] ([id], [nama]) VALUES (4, N'S2 MTRTI')
SET IDENTITY_INSERT [dbo].[prodis] OFF
GO
INSERT [dbo].[tingkatans] ([id], [nama], [point]) VALUES (1, N'Internasional', 1000)
INSERT [dbo].[tingkatans] ([id], [nama], [point]) VALUES (2, N'Nasional', 500)
INSERT [dbo].[tingkatans] ([id], [nama], [point]) VALUES (3, N'Provinsi', 250)
INSERT [dbo].[tingkatans] ([id], [nama], [point]) VALUES (4, N'Regional', 100)
GO
SET IDENTITY_INSERT [dbo].[users] ON 

INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (1, N'admin1', N'admin', N'admin', N'admin')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (2, N'Atmin1', N'admin', N'admin123', N'admin')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (3, N'admin2', N'admin2', N'admin123', N'admin')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (4, N'admin3', N'admin3', N'admin123', N'admin')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (5, N'admin4', N'admin4', N'admin123', N'admin')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (21, N'Adi Putra', N'2341720201', N'2341720201', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (22, N'Budi Santoso', N'2341720202', N'2341720202', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (23, N'Citra Dewi', N'2341720203', N'2341720203', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (24, N'Dedi Prasetyo', N'2341720204', N'2341720204', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (25, N'Eka Susanti', N'2341720205', N'2341720205', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (26, N'Fajar Mahendra', N'2341720206', N'2341720206', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (27, N'Gita Sari', N'2341720207', N'2341720207', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (28, N'Hadi Kusuma', N'2341720208', N'2341720208', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (29, N'Ika Widyaningrum', N'2341720209', N'2341720209', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (30, N'Joko Priyono', N'2341720210', N'2341720210', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (31, N'Kiki Ramadhani', N'2341720211', N'2341720211', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (32, N'Lina Kartika', N'2341720212', N'2341720212', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (33, N'Miko Hardianto', N'2341720213', N'2341720213', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (34, N'Nina Putri', N'2341720214', N'2341720214', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (35, N'Omar Ali', N'2341720215', N'2341720215', N'mahasiswa')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (36, N'Ahmad Fauzi, S.Pd., M.T.', N'12345678', N'12345678', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (37, N'Budi Santoso, S.Pd., M.T.', N'87654321', N'87654321', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (38, N'Citra Dewi, S.Pd., M.T.', N'11223344', N'11223344', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (39, N'Dedi Saputra, S.Pd., M.T.', N'44332211', N'44332211', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (40, N'Eka Prasetyo, S.Pd., M.T.', N'55667788', N'55667788', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (41, N'Fitria Sari, S.Pd., M.T.', N'88776655', N'88776655', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (42, N'Gilang Ramadhan, S.Pd., M.T.', N'99887766', N'99887766', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (43, N'Hana Permata, S.Pd., M.T.', N'66778899', N'66778899', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (44, N'Irfan Hakim, S.Pd., M.T.', N'22334455', N'22334455', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (45, N'Joko Susilo, S.Pd., M.T.', N'55443322', N'55443322', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (46, N'Karin Putri, S.Pd., M.T.', N'77889900', N'77889900', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (47, N'Lutfi Mahendra, S.Pd., M.T.', N'00998877', N'00998877', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (48, N'Maya Anjani, S.Pd., M.T.', N'66554433', N'66554433', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (49, N'Nanda Pratama, S.Pd., M.T.', N'33221100', N'33221100', N'dosen')
INSERT [dbo].[users] ([id], [name], [username], [password], [role]) VALUES (50, N'Oki Wibowo, S.Pd., M.T.', N'99001122', N'99001122', N'dosen')
SET IDENTITY_INSERT [dbo].[users] OFF
GO
/****** Object:  Index [UQ__admins__B9BE370E0CF6FB08]    Script Date: 02/12/2024 14.17.24 ******/
ALTER TABLE [dbo].[admins] ADD UNIQUE NONCLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
/****** Object:  Index [UQ__dosens__B9BE370E681B9754]    Script Date: 02/12/2024 14.17.24 ******/
ALTER TABLE [dbo].[dosens] ADD UNIQUE NONCLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ__mahasisw__DF97D0EB0B27E848]    Script Date: 02/12/2024 14.17.24 ******/
ALTER TABLE [dbo].[mahasiswas] ADD UNIQUE NONCLUSTERED 
(
	[nim] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[admins]  WITH CHECK ADD  CONSTRAINT [FK_admins_users] FOREIGN KEY([user_id])
REFERENCES [dbo].[users] ([id])
GO
ALTER TABLE [dbo].[admins] CHECK CONSTRAINT [FK_admins_users]
GO
ALTER TABLE [dbo].[dosens]  WITH CHECK ADD  CONSTRAINT [FK_dosens_users] FOREIGN KEY([user_id])
REFERENCES [dbo].[users] ([id])
GO
ALTER TABLE [dbo].[dosens] CHECK CONSTRAINT [FK_dosens_users]
GO
ALTER TABLE [dbo].[mahasiswas]  WITH CHECK ADD  CONSTRAINT [FK_mahasiswas_prodis] FOREIGN KEY([prodi_id])
REFERENCES [dbo].[prodis] ([id])
GO
ALTER TABLE [dbo].[mahasiswas] CHECK CONSTRAINT [FK_mahasiswas_prodis]
GO
ALTER TABLE [dbo].[mahasiswas]  WITH CHECK ADD  CONSTRAINT [FK_mahasiswas_users] FOREIGN KEY([user_id])
REFERENCES [dbo].[users] ([id])
GO
ALTER TABLE [dbo].[mahasiswas] CHECK CONSTRAINT [FK_mahasiswas_users]
GO
ALTER TABLE [dbo].[penghargaans]  WITH CHECK ADD  CONSTRAINT [FK_penghargaans_mahasiswas] FOREIGN KEY([mahasiswa_id])
REFERENCES [dbo].[mahasiswas] ([id])
GO
ALTER TABLE [dbo].[penghargaans] CHECK CONSTRAINT [FK_penghargaans_mahasiswas]
GO
ALTER TABLE [dbo].[penghargaans]  WITH CHECK ADD  CONSTRAINT [FK_penghargaans_peringkats] FOREIGN KEY([peringkat_id])
REFERENCES [dbo].[peringkats] ([id])
GO
ALTER TABLE [dbo].[penghargaans] CHECK CONSTRAINT [FK_penghargaans_peringkats]
GO
ALTER TABLE [dbo].[penghargaans]  WITH CHECK ADD  CONSTRAINT [FK_penghargaans_tingkatans] FOREIGN KEY([tingkat_id])
REFERENCES [dbo].[tingkatans] ([id])
GO
ALTER TABLE [dbo].[penghargaans] CHECK CONSTRAINT [FK_penghargaans_tingkatans]
GO
ALTER TABLE [dbo].[verifikasis]  WITH CHECK ADD  CONSTRAINT [FK_verifikasis_admins] FOREIGN KEY([admin_id])
REFERENCES [dbo].[admins] ([id])
GO
ALTER TABLE [dbo].[verifikasis] CHECK CONSTRAINT [FK_verifikasis_admins]
GO
ALTER TABLE [dbo].[verifikasis]  WITH CHECK ADD  CONSTRAINT [FK_verifikasis_dosens] FOREIGN KEY([dosen_id])
REFERENCES [dbo].[dosens] ([id])
GO
ALTER TABLE [dbo].[verifikasis] CHECK CONSTRAINT [FK_verifikasis_dosens]
GO
ALTER TABLE [dbo].[verifikasis]  WITH CHECK ADD  CONSTRAINT [FK_verifikasis_mahasiswas] FOREIGN KEY([mahasiswa_id])
REFERENCES [dbo].[mahasiswas] ([id])
GO
ALTER TABLE [dbo].[verifikasis] CHECK CONSTRAINT [FK_verifikasis_mahasiswas]
GO
ALTER TABLE [dbo].[verifikasis]  WITH CHECK ADD  CONSTRAINT [FK_verifikasis_penghargaans] FOREIGN KEY([penghargaan_id])
REFERENCES [dbo].[penghargaans] ([id])
GO
ALTER TABLE [dbo].[verifikasis] CHECK CONSTRAINT [FK_verifikasis_penghargaans]
GO
ALTER TABLE [dbo].[admins]  WITH CHECK ADD CHECK  (([gender]='P' OR [gender]='L'))
GO
ALTER TABLE [dbo].[dosens]  WITH CHECK ADD CHECK  (([gender]='P' OR [gender]='L'))
GO
ALTER TABLE [dbo].[mahasiswas]  WITH CHECK ADD CHECK  (([gender]='p' OR [gender]='l'))
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD CHECK  (([role]='admin' OR [role]='dosen' OR [role]='mahasiswa'))
GO
USE [master]
GO
ALTER DATABASE [san_sigma1] SET  READ_WRITE 
GO
