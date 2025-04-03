-- Tạo cơ sở dữ liệu
CREATE DATABASE ReBook;
GO

-- Sử dụng cơ sở dữ liệu
USE ReBook;
GO

-- Bảng Users: Lưu thông tin người dùng
CREATE TABLE Users (
    UserID INT IDENTITY(1,1) PRIMARY KEY,
    FullName NVARCHAR(100) NOT NULL,
    Email NVARCHAR(100) UNIQUE NOT NULL,
    PasswordHash NVARCHAR(255) NOT NULL,
    Address NVARCHAR(MAX),
    PhoneNumber NVARCHAR(15),
    Role NVARCHAR(20) CHECK (Role IN ('Customer', 'Admin')) DEFAULT 'Customer',
    IsActive BIT DEFAULT 1,
    CreatedAt DATETIME DEFAULT GETDATE(),
    UpdatedAt DATETIME DEFAULT GETDATE()
);

-- Bảng ShippingAddresses: Lưu địa chỉ giao hàng của người dùng
CREATE TABLE ShippingAddresses (
    AddressID INT IDENTITY(1,1) PRIMARY KEY,
    UserID INT NOT NULL,
    FullName NVARCHAR(100) NOT NULL,
    AddressLine1 NVARCHAR(255) NOT NULL,
    AddressLine2 NVARCHAR(255),
    City NVARCHAR(100) NOT NULL,
    State NVARCHAR(100) NOT NULL,
    PostalCode NVARCHAR(20) NOT NULL,
    Country NVARCHAR(100) NOT NULL,
    PhoneNumber NVARCHAR(15),
    IsDefault BIT DEFAULT 0,
    CreatedAt DATETIME2 DEFAULT GETDATE(),
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- Bảng Categories: Lưu danh mục sản phẩm
CREATE TABLE Categories (
    CategoryID INT IDENTITY(1,1) PRIMARY KEY,
    Name NVARCHAR(100) NOT NULL UNIQUE,
    Description NVARCHAR(MAX),
    ParentCategoryID INT NULL,
    CreatedAt DATETIME DEFAULT GETDATE(),
    UpdatedAt DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (ParentCategoryID) REFERENCES Categories(CategoryID) ON DELETE SET NULL
);

-- Bảng Products: Lưu thông tin sản phẩm
CREATE TABLE Products (
    ProductID INT IDENTITY(1,1) PRIMARY KEY,
    Name NVARCHAR(100) NOT NULL,
    Description NVARCHAR(MAX),
    Price DECIMAL(10, 2) NOT NULL,
    Stock INT NOT NULL,
    CategoryID INT NOT NULL,
    ImageURL NVARCHAR(255),
    IsFeatured BIT DEFAULT 0,
    CreatedAt DATETIME2 DEFAULT GETDATE(),
    UpdatedAt DATETIME2 DEFAULT GETDATE(),
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID) ON DELETE SET NULL
);

-- Bảng Coupons: Lưu thông tin mã giảm giá
CREATE TABLE Coupons (
    CouponID INT IDENTITY(1,1) PRIMARY KEY,
    Code NVARCHAR(50) UNIQUE NOT NULL,
    DiscountPercentage DECIMAL(5, 2) CHECK (DiscountPercentage BETWEEN 0 AND 100),
    MaxDiscountAmount DECIMAL(10, 2),
    ExpiryDate DATE NOT NULL,
    IsActive BIT DEFAULT 1,
    CreatedAt DATETIME2 DEFAULT GETDATE()
);

-- Bảng Orders: Lưu thông tin đơn hàng
CREATE TABLE Orders (
    OrderID INT IDENTITY(1,1) PRIMARY KEY,
    UserID INT NOT NULL,
    ShippingAddressID INT NOT NULL,
    CouponID INT NULL,
    TotalAmount DECIMAL(10, 2) NOT NULL,
    DiscountAmount DECIMAL(10, 2) DEFAULT 0.00,
    FinalAmount DECIMAL(10, 2) NOT NULL,
    OrderStatus NVARCHAR(20) CHECK (OrderStatus IN ('Pending', 'Shipped', 'Delivered', 'Cancelled')) DEFAULT 'Pending',
    PaymentMethod NVARCHAR(20) CHECK (PaymentMethod IN ('Credit Card', 'PayPal', 'Cash on Delivery')) NOT NULL,
    CreatedAt DATETIME DEFAULT GETDATE(),
    UpdatedAt DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (ShippingAddressID) REFERENCES ShippingAddresses(AddressID) ON DELETE CASCADE,
    FOREIGN KEY (CouponID) REFERENCES Coupons(CouponID) ON DELETE SET NULL
);

-- Bảng OrderDetails: Lưu chi tiết từng sản phẩm trong đơn hàng
CREATE TABLE OrderDetails (
    OrderDetailID INT IDENTITY(1,1) PRIMARY KEY,
    OrderID INT NOT NULL,
    ProductID INT NOT NULL,
    Quantity INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID) ON DELETE SET NULL
);

-- Bảng Cart: Lưu thông tin giỏ hàng của người dùng
CREATE TABLE Cart (
    CartID INT IDENTITY(1,1) PRIMARY KEY,
    UserID INT NOT NULL,
    ProductID INT NOT NULL,
    Quantity INT NOT NULL,
    CreatedAt DATETIME2 DEFAULT GETDATE(),
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID) ON DELETE SET NULL
);

-- Bảng Reviews: Lưu đánh giá sản phẩm của người dùng
CREATE TABLE Reviews (
    ReviewID INT IDENTITY(1,1) PRIMARY KEY,
    ProductID INT NOT NULL,
    UserID INT NOT NULL,
    Rating INT CHECK (Rating BETWEEN 1 AND 5),
    Comment NVARCHAR(MAX),
    CreatedAt DATETIME2 DEFAULT GETDATE(),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID) ON DELETE SET NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- Bảng PaymentMethods: Lưu thông tin phương thức thanh toán
CREATE TABLE PaymentMethods (
    PaymentMethodID INT IDENTITY(1,1) PRIMARY KEY,
    UserID INT NOT NULL,
    Method NVARCHAR(50) NOT NULL CHECK (Method IN ('Credit Card', 'PayPal', 'Bank Transfer')),
    Details NVARCHAR(MAX),
    CreatedAt DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- Bảng TransactionHistory: Lưu lịch sử giao dịch
CREATE TABLE TransactionHistory (
    TransactionID INT IDENTITY(1,1) PRIMARY KEY,
    OrderID INT NOT NULL,
    PaymentMethodID INT NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    TransactionDate DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE,
    FOREIGN KEY (PaymentMethodID) REFERENCES PaymentMethods(PaymentMethodID) ON DELETE CASCADE
);

-- Bảng WishList: Lưu danh sách yêu thích của người dùng
CREATE TABLE WishList (
    WishListID INT IDENTITY(1,1) PRIMARY KEY,
    UserID INT NOT NULL,
    ProductID INT NOT NULL,
    CreatedAt DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID) ON DELETE SET NULL
);

-- Thêm chỉ mục để tối ưu hóa tìm kiếm
CREATE INDEX idx_product_name ON Products(Name);
CREATE INDEX idx_category_name ON Categories(Name);
CREATE INDEX idx_user_email ON Users(Email);
CREATE INDEX idx_order_status ON Orders(OrderStatus);
CREATE INDEX idx_coupon_code ON Coupons(Code);
