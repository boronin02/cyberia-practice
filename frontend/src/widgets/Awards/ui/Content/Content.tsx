import styles from "./Content.module.scss";
import { contents } from "@/entities/awards/model/awards.data";
import Image from "next/image";

export const Content = () => {
  return (
    <>
      {contents.map((content) => (
        <div className={styles.content} key={content.alt}>
          <div className={styles.image}>
            <Image
              src={content.src}
              alt={content.alt}
              width={content.width}
              height={content.height}
            />
          </div>
          <div className={styles.text}>
            <div className={styles.textTop}>{content.title}</div>
            <div className={styles.textBottom}>{content.text}</div>
            <div className={styles.subText}>
              {content.subText}

              {content.svg && (
                <Image src={content.svg} alt="" width={content.width} height={content.height} />
              )}
            </div>
          </div>
        </div>
      ))}
    </>
  );
};
