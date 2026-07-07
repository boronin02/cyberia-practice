import Image from "next/image";
import styles from "./Logos.module.scss";
import { logos } from "@/entities/hero/model/hero.data";

export const Logos = () => {
  return (
    <div className={styles.logosWrapper}>
      <div className={styles.track}>
        {logos.map((logo) => (
          <Image
            key={`first-${logo.alt}`}
            src={logo.src}
            alt={logo.alt}
            width={logo.width}
            height={logo.height}
          />
        ))}
      </div>

      <div className={styles.track}>
        {logos.map((logo) => (
          <Image
            key={`second-${logo.alt}`}
            src={logo.src}
            alt={logo.alt}
            width={logo.width}
            height={logo.height}
          />
        ))}
      </div>
    </div>
  );
};
