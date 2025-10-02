import React from "react";
import Button from "./Button";

/*
 props:
  - pages: array of strings (svaka string predstavlja jednu stranu)
  - isSubscribed: boolean
  - onSubscribe: function (poziva se kada korisnik klikne subscribe iz readera)
*/
export default function Reader({
  pages = [],
  isSubscribed = false,
  onSubscribe,
}) {
  const visiblePages = isSubscribed ? pages : pages.slice(0, 10);

  return (
    <div className="reader">
      <div>
        {visiblePages.map((p, idx) => (
          <div key={idx} className="page">
            <div style={{ fontSize: 14, lineHeight: 1.6 }}>{p}</div>
          </div>
        ))}
      </div>

      {!isSubscribed && pages.length > 10 && (
        <div className="reader-footer">
          <div className="text-muted">
            Vidite prvih 10 strana. Pretplatite se za celu knjigu.
          </div>
          <div>
            <Button onClick={onSubscribe}>Pretplati se</Button>
          </div>
        </div>
      )}
    </div>
  );
}
