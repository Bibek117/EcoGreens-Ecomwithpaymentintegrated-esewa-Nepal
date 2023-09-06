import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import swal from "sweetalert";

const ProductDetail = () => {
    const [product, setProduct] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState("");

    const [selectedImage, setSelectedImage] = useState();
    const [quantity, setQuantity] = useState(1);

    const search = window.location.pathname;
    let slug = search.split("/").slice(-1).pop();

    useEffect(() => {
        axios
            .get(`/product-detail/${slug}`)
            .then((res) => {
                console.log(res.data.product.media);
                if (res.status === 200) {
                    setProduct(res.data.product);
                    setSelectedImage(res.data.product.media[0].original_url);
                }
                setLoading(false);
            })
            .catch((error) => {
                setError(error.response.statusText);
                setLoading(false);
            });
    }, []);

    const addToCart = (e) => {
        e.preventDefault();

        const productId = product.id;

        axios.post("/carts", { productId, quantity }).then((res) => {
            if (res.status === 200) {
                swal("Success", "Added to Cart !", "success");
                window.location.reload();
            }
        });
    };

    return (
        <>
            {loading ? (
                <h3>Loading...</h3>
            ) : (
                <div className="container">
                    <div className="row">
                        <div className="col-lg-6 col-md-6">
                            <div className="product__details__pic">
                                <div className="product__details__pic__item">
                                    <img
                                        className="product__details__pic__item--large"
                                        src={selectedImage}
                                        alt="mm"
                                    />
                                </div>
                                <div
                                    className="product__details__pic__slider"
                                    style={{
                                        columnGap: ".8rem",
                                        display: "flex",
                                    }}
                                >
                                    {product.media.map((p) => {
                                        return (
                                            <img
                                                style={{ width: "100px" }}
                                                key={p.id}
                                                src={p.original_url}
                                                alt={p.file_name}
                                                onClick={() =>
                                                    setSelectedImage(
                                                        p.original_url
                                                    )
                                                }
                                            />
                                        );
                                    })}
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-6 col-md-6">
                            <div className="product__details__text">
                                <h3>{product.name}</h3>
                                
                                <div className="product__details__price">
                                    Rs{product.price}
                                </div>
                                <p>{product.description}</p>
                                <form
                                    onSubmit={addToCart}
                                    style={{ display: "inline-block" }}
                                >
                                    <div className="product__details__quantity">
                                        <div className="quantity">
                                            <div className="pro-qty">
                                                <select
                                                    style={{ height: "50px" }}
                                                    className="form-control"
                                                    value={quantity}
                                                    name="quantity"
                                                    onChange={(e) =>
                                                        setQuantity(
                                                            e.target.value
                                                        )
                                                    }
                                                >
                                                    {[
                                                        ...Array(
                                                            product.quantity
                                                        ).keys(),
                                                    ].map((x) => (
                                                        <option
                                                            key={x + 1}
                                                            value={x + 1}
                                                        >
                                                            {x + 1}
                                                        </option>
                                                    ))}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        type="submit"
                                        className="primary-btn"
                                        style={{ border: "none" }}
                                    >
                                        ADD TO CARD
                                    </button>
                                </form>
                               
                             
                            </div>
                        </div>
                        <div className="col-lg-12">
                            <div className="product__details__tab">
                                <ul className="nav nav-tabs" role="tablist">
                                    <li className="nav-item">
                                        <a
                                            className="nav-link active"
                                            data-toggle="tab"
                                            href="#tabs-1"
                                            role="tab"
                                            aria-selected="true"
                                        >
                                            Description
                                        </a>
                                    </li>
                                   
                                </ul>
                                <div className="tab-content">
                                    <div
                                        className="tab-pane active"
                                        id="tabs-1"
                                        role="tabpanel"
                                    >
                                        <div className="product__details__tab__desc">
                                            <h6>Products Infomation</h6>
                                            {product.details}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )}
        </>
    );
};

export default ProductDetail;

if (document.getElementById("product-detail")) {
    ReactDOM.render(
        <ProductDetail />,
        document.getElementById("product-detail")
    );
}
